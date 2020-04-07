<?php declare(strict_types=1);


namespace App\Models;

use Swoft\Db\Annotation\Mapping\Column;
use Swoft\Db\Annotation\Mapping\Entity;
use Swoft\Db\Annotation\Mapping\Id;
use Swoft\Db\Eloquent\Model;


/**
 * 
 * Class CourseKinds
 *
 * @since 2.0
 *
 * @Entity(table="course_kinds")
 */
class CourseKinds extends Model
{
    /**
     * 
     * @Id()
     * @Column(name="item_id", prop="itemId")
     *
     * @var int
     */
    private $itemId;

    /**
     * 类别名称
     *
     * @Column(name="kind_name", prop="kindName")
     *
     * @var string|null
     */
    private $kindName;

    /**
     * 父级ID
     *
     * @Column()
     *
     * @var int|null
     */
    private $pid;

    /**
     * 所有父级ID
     *
     * @Column()
     *
     * @var string|null
     */
    private $pids;

    /**
     * 扩展字段1
     *
     * @Column()
     *
     * @var string|null
     */
    private $ext1;

    /**
     * 扩展字段2
     *
     * @Column()
     *
     * @var string|null
     */
    private $ext2;


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
     * @param string|null $kindName
     *
     * @return void
     */
    public function setKindName(?string $kindName): void
    {
        $this->kindName = $kindName;
    }

    /**
     * @param int|null $pid
     *
     * @return void
     */
    public function setPid(?int $pid): void
    {
        $this->pid = $pid;
    }

    /**
     * @param string|null $pids
     *
     * @return void
     */
    public function setPids(?string $pids): void
    {
        $this->pids = $pids;
    }

    /**
     * @param string|null $ext1
     *
     * @return void
     */
    public function setExt1(?string $ext1): void
    {
        $this->ext1 = $ext1;
    }

    /**
     * @param string|null $ext2
     *
     * @return void
     */
    public function setExt2(?string $ext2): void
    {
        $this->ext2 = $ext2;
    }

    /**
     * @return int
     */
    public function getItemId(): ?int
    {
        return $this->itemId;
    }

    /**
     * @return string|null
     */
    public function getKindName(): ?string
    {
        return $this->kindName;
    }

    /**
     * @return int|null
     */
    public function getPid(): ?int
    {
        return $this->pid;
    }

    /**
     * @return string|null
     */
    public function getPids(): ?string
    {
        return $this->pids;
    }

    /**
     * @return string|null
     */
    public function getExt1(): ?string
    {
        return $this->ext1;
    }

    /**
     * @return string|null
     */
    public function getExt2(): ?string
    {
        return $this->ext2;
    }

}
