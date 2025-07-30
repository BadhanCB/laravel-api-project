<?php
namespace App\Http\Controllers;

use App\Models\Article;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class ArticleController extends Controller {
  function getAllArticles() {
    return Article::all();
  }

  //   function getArticle($id) {
  //     return Article::findOrFail($id);
  //   }

  function getArticle(Article $article) {
    return $article;
  }

  function createArticle(Request $request) {
    try {
      $newArticleData = $request->validate([
        'title'   => ['required'],
        'content' => ['required'],
      ]);

      $article          = new Article();
      $user             = $request->user();
      $article->title   = $newArticleData['title'];
      $article->content = $newArticleData['content'];
      $article->user_id = $user->id;

      $result = $article->save();
      if ($result) {
        return response()->json(['message' => 'Article Created Successfully.'], 201);
      } else {
        return response()->json(['message' => 'Operation Failed! Article Not Created.'], 500);
      }
    } catch (ValidationException $e) {
      return new JsonResponse([
        'message' => 'Validation Failed.',
        'errors'  => $e->errors(),
      ], 422);
    } catch (Exception $e) {
      return new JsonResponse([
        'message' => 'Internal Server Error',
      ], 500);
    }
  }

  function updateArticle(Request $request, Article $article) {
    $user = $request->user();

    if ($user->id !== $article->user_id) {
      return response()->json(['message' => 'You are not authorized to Update this article'], 404);
    }

    $article->title   = $request->title;
    $article->content = $request->content;
    $article->save();

    return $article;
  }

  function deleteArticle(Request $request, Article $article) {
    $user = $request->user();

    if ($user->id !== $article->user_id) {
      return response()->json(['message' => 'You are not authorized to Delete this article'], 404);
    }

    $article->delete();

    return response()->json(['message' => 'Article deleted successfully'], 200);
  }
}
