<?php
if (!defined('__TYPECHO_ROOT_DIR__')) {
    exit;
}

/**
 * Typecho 会把留空的文章标题保存为“未命名文档”。
 * 在碎碎念纸条中将它视为未设置，避免展示系统占位文字。
 */
function ato_murmur_has_visible_title($title)
{
    $title = trim((string) $title);
    $untitled = trim((string) _t('未命名文档'));

    return $title !== '' && $title !== $untitled && $title !== '未命名文档';
}

/**
 * 判断当前文章是否属于主题设置中选定的碎碎念分类。
 */
function ato_is_murmur_post($post, $options)
{
    $categoryId = ato_murmur_category_id($options);
    if ($categoryId < 1 || !$post) {
        return false;
    }

    foreach ((array) $post->categories as $category) {
        if (isset($category['mid']) && (int) $category['mid'] === $categoryId) {
            return true;
        }
    }

    return false;
}

/**
 * 查询指定分类中的文章，或从普通文章流中排除该分类。
 *
 * 碎碎念仍然是 Typecho 原生文章，因此可以继续使用 Markdown、附件、评论与插件；
 * 这里仅负责为首页和碎碎念独立页提供准确的查询与分页总数。
 */
class AtoPaperMurmurPosts extends \Widget\Base\Contents
{
    private $totalCount = 0;
    private $currentPageNumber = 1;
    private $pageSizeNumber = 8;

    public function execute()
    {
        $this->parameter->setDefault([
            'categoryId' => 0,
            'mode' => 'include',
            'currentPage' => 1,
            'pageSize' => 8,
        ]);

        $categoryId = max(0, (int) $this->parameter->categoryId);
        $mode = (string) $this->parameter->mode === 'exclude' ? 'exclude' : 'include';
        $this->currentPageNumber = max(1, (int) $this->parameter->currentPage);
        $this->pageSizeNumber = max(1, min(50, (int) $this->parameter->pageSize));

        static $relatedIdCache = [];
        $relatedIds = [];
        if ($categoryId > 0) {
            if (array_key_exists($categoryId, $relatedIdCache)) {
                $relatedIds = $relatedIdCache[$categoryId];
            } else {
                $relationships = $this->db->fetchAll(
                    $this->db->select('table.relationships.cid')
                        ->from('table.relationships')
                        ->where('table.relationships.mid = ?', $categoryId)
                );
                foreach ($relationships as $relationship) {
                    $cid = isset($relationship['cid']) ? (int) $relationship['cid'] : 0;
                    if ($cid > 0) {
                        $relatedIds[] = $cid;
                    }
                }
                $relatedIds = array_values(array_unique($relatedIds));
                $relatedIdCache[$categoryId] = $relatedIds;
            }
        }

        $select = $this->select('table.contents.*');
        if ($this->user->hasLogin()) {
            $select->where(
                'table.contents.status = ? OR (table.contents.status = ? AND table.contents.authorId = ?)',
                'publish',
                'private',
                $this->user->uid
            );
        } else {
            $select->where('table.contents.status = ?', 'publish');
        }
        $select->where('table.contents.created < ?', $this->options->time)
            ->where('table.contents.type = ?', 'post');

        if ($mode === 'include') {
            if ($categoryId < 1 || empty($relatedIds)) {
                $select->where('table.contents.cid = ?', 0);
            } else {
                $select->where('table.contents.cid IN ?', $relatedIds);
            }
        } elseif (!empty($relatedIds)) {
            $select->where('table.contents.cid NOT IN ?', $relatedIds);
        }

        $this->totalCount = (int) $this->size(clone $select);
        $select->order('table.contents.created', \Typecho\Db::SORT_DESC)
            ->page($this->currentPageNumber, $this->pageSizeNumber);
        $this->db->fetchAll($select, [$this, 'push']);
    }

    public function getTotalCount()
    {
        return $this->totalCount;
    }

    public function getCurrentPageNumber()
    {
        return $this->currentPageNumber;
    }

    public function getPageSizeNumber()
    {
        return $this->pageSizeNumber;
    }
}
