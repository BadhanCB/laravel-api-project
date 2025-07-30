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
        'user_id' => ['required'],
        'title'   => ['required'],
        'content' => ['required'],
      ]);

      $article          = new Article();
      $article->title   = $newArticleData['title'];
      $article->content = $newArticleData['content'];
      $article->user_id = $newArticleData['user_id'];

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
}
