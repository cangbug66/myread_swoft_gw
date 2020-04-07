<?php declare(strict_types=1);


namespace App\Models;

use Swoft\Db\Annotation\Mapping\Column;
use Swoft\Db\Annotation\Mapping\Entity;
use Swoft\Db\Annotation\Mapping\Id;
use Swoft\Db\Eloquent\Model;


/**
 * 包含了课程点击量、收藏数、附件名或其他自定义等等
 * Class CourseMetas
 *
 * @since 2.0
 *
 * @Entity(table="course_metas")
 */
class CourseMetas extends Model
{
    /**
     * 主键
     * @Id()
     * @Column(name="item_id", prop="itemId")
     *
     * @var int
     */
    private $itemId;

    /**
     * 课程ID
     *
     * @Column(name="course_id", prop="courseId")
     *
     * @var int|null
     */
    private $courseId;

    /**
     * 元信息名称
     *
     * @Column(name="meta_name", prop="metaName")
     *
     * @var string|null
     */
    private $metaName;

    /**
     * 元信息内容
     *
     * @Column(name="meta_value", prop="metaValue")
     *
     * @var string|null
     */
    private $metaValue;


    /**
     * @param int $itemId
     *
     * @return void
     */
    public function setItemId(int $itemId): void
    {
        $this->itemId = $itemId;
    }

    /**
     * @param int|null $courseId
     *
     * @return void
     */
    public function setCourseId(?int $courseId): void
    {
        $this->courseId = $courseId;
    }

    /**
     * @param string|null $metaName
     *
     * @return void
     */
    public function setMetaName(?string $metaName): void
    {
        $this->metaName = $metaName;
    }

    /**
     * @param string|null $metaValue
     *
     * @return void
     */
    public function setMetaValue(?string $metaValue): void
    {
        $this->metaValue = $metaValue;
    }

    /**
     * @return int
     */
    public function getItemId(): ?int
    {
        return $this->itemId;
    }

    /**
     * @return int|null
     */
    public function getCourseId(): ?int
    {
        return $this->courseId;
    }

    /**
     * @return string|null
     */
    public function getMetaName(): ?string
    {
        return $this->metaName;
    }

    /**
     * @return string|null
     */
    public function getMetaValue(): ?string
    {
        return $this->metaValue;
    }

}
