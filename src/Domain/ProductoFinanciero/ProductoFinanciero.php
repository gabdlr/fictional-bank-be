<?
namespace App\Domain\ProductoFinanciero;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity()
 */
class ProductoFinanciero {

  /**
   * @ORM\Id
   * @ORM\GeneratedValue()
   * @ORM\Column(type="integer")
   */
  private int $id;
  
  /**
   * @ORM\Column(type="string", length=255)
   */
  private string $name;

  /**
   * @ORM\Column(type="string", length=255)
   */
  private string $description;

  /**
   * @ORM\Column(type="string")
   */
  private string $logo;

  /**
   * @ORM\Column(type="string", length=255)
   */
  private string $date_release;

  /**
   * @ORM\Column(type="string", length=255)
   */
  private string $date_revision;
  

  /**
   * Get the value of id
   */ 
  public function getId()
  {
    return $this->id;
  }

  /**
   * Get the value of name
   */ 
  public function getName()
  {
    return $this->name;
  }

  /**
   * Set the value of name
   *
   * @return  self
   */ 
  public function setName($name)
  {
    $this->name = $name;

    return $this;
  }

  /**
   * Get the value of description
   */ 
  public function getDescription()
  {
    return $this->description;
  }

  /**
   * Set the value of description
   *
   * @return  self
   */ 
  public function setDescription($description)
  {
    $this->description = $description;

    return $this;
  }

  /**
   * Get the value of logo
   */ 
  public function getLogo()
  {
    return $this->logo;
  }

  /**
   * Set the value of logo
   *
   * @return  self
   */ 
  public function setLogo($logo)
  {
    $this->logo = $logo;

    return $this;
  }

  /**
   * Get the value of date_release
   */ 
  public function getDate_release()
  {
    return $this->date_release;
  }

  /**
   * Set the value of date_release
   *
   * @return  self
   */ 
  public function setDate_release($date_release)
  {
    $this->date_release = $date_release;

    return $this;
  }

  /**
   * Get the value of date_revision
   */ 
  public function getDate_revision()
  {
    return $this->date_revision;
  }

  /**
   * Set the value of date_revision
   *
   * @return  self
   */ 
  public function setDate_revision($date_revision)
  {
    $this->date_revision = $date_revision;

    return $this;
  }
}