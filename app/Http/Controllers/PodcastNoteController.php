<?php

namespace App\Http\Controllers;

use App\Models\PodcastNote;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class PodcastNoteController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        $search = trim((string) $request->query('search', ''));

        $query = PodcastNote::query();

        if ($search !== '') {
            $query->where(function ($builder) use ($search): void {
                $builder->where('title', 'like', "%{$search}%")
                    ->orWhere('summary', 'like', "%{$search}%")
                    ->orWhere('category', 'like', "%{$search}%");
            });
        }

        return response()->json([
            'data' => $query->latest()->get(),
        ]);
    }

    public function store(Request $request): JsonResponse
    {
        if ($request->all() === []) {
            return response()->json([
                'message' => 'Payload is required.',
            ], 422);
        }

        $podcastNote = PodcastNote::create([
            'title' => $request->input('title'),
            'content' => $request->input('content'),
            'summary' => $request->input('summary'),
            'category' => $request->input('category'),
            'estimatedDuration' => $request->input('estimatedDuration'),
            'status' => $request->input('status'),
        ]);

        return response()->json([
            'message' => 'Podcast note saved successfully.',
            'data' => $podcastNote,
        ], 201);
    }

    public function update(Request $request, int $id): JsonResponse
    {
        $podcastNote = PodcastNote::find($id);

        if (! $podcastNote) {
            return response()->json([
                'message' => 'Podcast note not found.',
            ], 404);
        }

        $data = array_filter([
            'title' => $request->input('title'),
            'content' => $request->input('content'),
            'summary' => $request->input('summary'),
            'category' => $request->input('category'),
            'estimatedDuration' => $request->input('estimatedDuration'),
            'status' => $request->input('status'),
        ], static fn ($value) => $value !== null);

        if ($data === []) {
            return response()->json([
                'message' => 'At least one field is required to update.',
            ], 422);
        }

        $podcastNote->update($data);

        return response()->json([
            'message' => 'Podcast note updated successfully.',
            'data' => $podcastNote->fresh(),
        ]);
    }

    public function destroy(int $id): JsonResponse
    {
        $podcastNote = PodcastNote::find($id);

        if (! $podcastNote) {
            return response()->json([
                'message' => 'Podcast note not found.',
            ], 404);
        }

        $podcastNote->delete();

        return response()->json([
            'message' => 'Podcast note deleted successfully.',
        ]);
    }
}
