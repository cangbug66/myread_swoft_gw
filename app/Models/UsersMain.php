<?php declare(strict_types=1);


namespace App\Models;

use Swoft\Db\Annotation\Mapping\Column;
use Swoft\Db\Annotation\Mapping\Entity;
use Swoft\Db\Annotation\Mapping\Id;
use Swoft\Db\Eloquent\Model;


/**
 * 
 * Class UsersMain
 *
 * @since 2.0
 *
 * @Entity(table="users_main")
 */
class UsersMain extends Model
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
     * 
     *
     * @Column(name="user_name", prop="userName")
     *
     * @var string
     */
    private $userName;

    /**
     * 
     *
     * @Column(name="user_pass", prop="userPass")
     *
     * @var string
     */
    private $userPass;

    /**
     * 
     *
     * @Column(name="user_date", prop="userDate")
     *
     * @var string|null
     */
    private $userDate;


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
     * @param string $userName
     *
     * @return void
     */
    public function setUserName(string $userName): void
    {
        $this->userName = $userName;
    }

    /**
     * @param string $userPass
     *
     * @return void
     */
    public function setUserPass(string $userPass): void
    {
        $this->userPass = $userPass;
    }

    /**
     * @param string|null $userDate
     *
     * @return void
     */
    public function setUserDate(?string $userDate): void
    {
        $this->userDate = $userDate;
    }

    /**
     * @return int
     */
    public function getItemId(): ?int
    {
        return $this->itemId;
    }

    /**
     * @return string
     */
    public function getUserName(): ?string
    {
        return $this->userName;
    }

    /**
     * @return string
     */
    public function getUserPass(): ?string
    {
        return $this->userPass;
    }

    /**
     * @return string|null
     */
    public function getUserDate(): ?string
    {
        return $this->userDate;
    }

}
