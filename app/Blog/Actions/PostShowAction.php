<?php

namespace App\Blog\Actions;

use App\Blog\Models\Posts;
use Framework\Actions\RouterAwareAction;
use Framework\Renderer\RendererInterface;
use Framework\Router;

/**
 * Undocumented class
 */
class PostShowAction
{
    use RouterAwareAction;

    /**
     *
     * @var RendererInterface
     */
    private $renderer;

    /**
     *
     * @var \Framework\Router
     */
    private $router;

    /**
     * Constructeur
     *
     * @param RendererInterface $renderer
     */
    public function __construct(
        RendererInterface $renderer,
        Router $router
    ) {
        $this->renderer = $renderer;
        $this->router = $router;
    }

    /**
     * Show blog post
     *
     * @param string $slug
     * @param int $id
     * @return string
     */
    public function __invoke(string $slug, int $id): string
    {
        //$slug = $request->getAttribute('slug');
        //$post = Posts::find($request->getAttribute('id'), ['include' => ['category']]);
        $post = Posts::find($id, ['include' => ['category']]);

        if ($post->slug !== $slug) {
            return $this->redirect('blog.show', [
                'slug' => $post->slug,
                'id' => $post->id
            ]);
        }

        return $this->renderer->render('@blog/show', [
            'post' => $post
        ]);
    }
}
