<?php

class Delight_ViewComponent_FormElement_Input extends Delight_ViewComponent_FormElement {

    private $type;
    private $checked = false;
    private $prefilled_value;
    private $disabled = false;

    public static function text(string $name, ?string $title = null, ?bool $required = false): self {
        $result = new self($name, $title, $required);
        return $result->set_type('text');
    }

    public static function email(string $name, ?string $title = null, ?bool $required = false): self {
        $result = new self($name, $title, $required);
        return $result->set_type('email');
    }

    public static function phone(string $name, ?string $title = null, ?bool $required = false): self {
        $result = new self($name, $title, $required);
        return $result->set_type('phone');
    }

    public static function password(string $name, ?string $title = null, ?bool $required = false): self {
        $result = new self($name, $title, $required);
        return $result->set_type('password');
    }

    public static function checkbox(string $name, ?string $title = null, ?bool $required = false): self {
        $result = new self($name, $title, $required);
        return $result->set_type('checkbox');
    }

    public static function hidden(string $name, string $value): self {
        $result = new self($name, null, true);
        $result->set_prefilled_value($value);
        return $result->set_type('hidden');
    }

    public function set_type(string $type): self {
        $this->type = $type;
        return $this;
    }

    public function get_type() {
        if (null === $this->type) $this->set_type('text');
        return $this->type;
    }

    public function set_disabled(?bool $disabled = true) {
        $this->disabled = $disabled;
        return $this;
    }

    public function is_disabled() {
        return $this->disabled;
    }

    public function set_prefilled_value(?string $prefilled_value = null) {
        Delight_Assert::not_equals($this->get_type(), 'checkbox', 'input of type checkbox is to be handled with set_checked');
        $this->prefilled_value = $prefilled_value;
        return $this;
    }

    public function get_prefilled_value() {
        return $this->prefilled_value;
    }

    public function set_checked(?bool $checked = true): self {
        Delight_Assert::equals($this->get_type(), 'checkbox', 'input of type ' . $this->get_type() . ' can not be \'checked\'');
        $this->checked = $checked;
        return $this;
    }

    public function get_checked() {
        return $this->checked;
    }

    public function is_checked() {
        Delight_Assert::equals($this->get_type(), 'checkbox', 'input of type ' . $this->get_type() . ' can not be \'checked\'');
        return $this->get_value() === 'on';
    }

}