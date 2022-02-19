<?php

namespace App\Entity;

use App\Repository\TitreTemplateRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TitreTemplateRepository::class)]
class TitreTemplate
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $text;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getText(): ?string
    {
        return $this->text;
    }

    public function setText(string $text): self
    {
        $this->text = $text;

        return $this;
    }
    public static function creation(string $text){
        $titletemplate = new self();
        $titletemplate ->setText($text);
        return $titletemplate;
    }
    public function getCompletedString($ingredients){
        $pos = null;
        $temp_text = $this->getText();
        $is_text_processed = true;
        while($is_text_processed) {
            $pos = strpos($temp_text, "!ingredient!");
            /** @var Ingredient $random_ingredient */
            $random_ingredient = $ingredients[rand(0, count($ingredients) - 1)];

            if ($pos !== false) {
                $temp_text = substr_replace($temp_text, $random_ingredient->getArticle()." ".$random_ingredient->getNom(), $pos, strlen("!ingredient!"));
            } else {
                $is_text_processed = false;
            }
        }
        return $temp_text;

    }

}
