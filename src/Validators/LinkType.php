<?php

namespace SocialValidate\Validators;

class LinkType
{
    public bool $isValid = false;

    public ?string $id = null;

    public ?string $type = null;

    public function __construct(bool $isValid = false, string $id = null, string $type = null)
    {
        $this->isValid = $isValid;
        $this->id = $id;
        $this->type = $type;
    }

    public function __toString()
    {
        return $this->toJson();
    }

    public function toJson(): string
    {
        return json_encode(
            [
                'isValid' => $this->isValid,
                'type' => $this->type,
                'id' => $this->id
            ]
        );
    }
}
