<?php

namespace shop\useCases\manage\Shop;

use shop\entities\Shop\Tag;
use shop\forms\manage\Shop\TagForm;
use shop\repositories\Shop\TagRepository;

class TagManageService
{
    /**
     * @var TagRepository
     */
    private $tags;

    /**
     * TagManageService constructor.
     * @param TagRepository $tags
     */
    public function __construct(TagRepository $tags)
    {
        $this->tags = $tags;
    }

    /**
     * @param TagForm $form
     * @return Tag
     */
    public function create(TagForm $form): Tag
    {
        $tag = Tag::create(
            $form->name,
            $form->slug
        );
        $this->tags->save($tag);
        return $tag;
    }

    /**
     * @param $id
     * @param TagForm $form
     */
    public function edit($id, TagForm $form): void
    {
        $tag = $this->tags->get($id);
        $tag->edit(
            $form->name,
            $form->slug
        );
        $this->tags->save($tag);
    }

    /**
     * @param $id
     * @throws \Throwable
     * @throws \yii\db\StaleObjectException
     */
    public function remove($id): void
    {
        $tag = $this->tags->get($id);
        $this->tags->remove($tag);
    }
}
