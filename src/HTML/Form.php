<?php

namespace App\HTML;

class Form {

    private $data;
    private $errors;

    public function __construct($data, array $errors) {
        $this->data = $data;
        $this->errors = $errors;
    }

    public function input(string $key, string $label): string {
        $value = $this->getValue($key);
        $inputClass = $this->getInputClass($key);
        $invalidFeedback = $this->getErrorsFeedback($key);
        $type = (strstr($key, "password")) ? "password" : "text";

        return <<<HTML
        <div class="form-group">
            <label for="field{$key}">{$label}</label>
            <input class="{$inputClass}" type="{$type}" name="{$key}" id="field{$key}" value="{$value}">
            {$invalidFeedback}
        </div>
HTML;
    }

    public function textarea(string $key, string $label): string {
        $value = $this->getValue($key);
        $inputClass = $this->getInputClass($key);
        $invalidFeedback = $this->getErrorsFeedback($key);

        return <<<HTML
        <div class="form-group">
            <label for="field{$key}">{$label}</label>
            <textarea class="{$inputClass}" type="text" name="{$key}" id="field{$key}">{$value}</textarea>
            {$invalidFeedback}
        </div>
HTML;
    }

    public function select(string $key, string $label, array $options = []): string 
    {
        $optionsHTML = [];
        $value = $this->getValue($key);
        foreach ($options as $k => $v) {
            $selected = (in_array($k, $value)) ? " selected " : "";
            $optionsHTML[] = "<option {$selected} value='{$k}'>{$v}</option>";
        }
        $optionsHTML = implode('', $optionsHTML);
        $inputClass = $this->getInputClass($key);
        $invalidFeedback = $this->getErrorsFeedback($key);

        return <<<HTML
        <div class="form-group">
            <label for="field{$key}">{$label}</label>
            <select class="{$inputClass}" name="{$key}[]" id="field{$key}" required multiple>{$optionsHTML}</select>
            {$invalidFeedback}
        </div>
HTML;
    }

    public function file(string $key, string $label): string {
        $inputClass = $this->getInputClass($key);
        $invalidFeedback = $this->getErrorsFeedback($key);

        return <<<HTML
        <div class="form-group">
            <label for="field{$key}">{$label}</label>
            <input class="{$inputClass}" type="file" name="{$key}" id="field{$key}">
            {$invalidFeedback}
        </div>
HTML;
    }


    private function getValue(string $key) {
        if (is_array($this->data)) {
            return $this->data[$key] ?? null;
        }
        if (strstr($key, "verify") || strstr($key, "password")) {
            return ;
        }
        $method = "get" . str_replace(' ', '', ucwords(str_replace('_', ' ', $key)));
        $value = $this->data->$method();
        if ($value instanceof \DateTimeInterface) {
            return $value->format("Y-m-d H:i:s");
        }
        return $value;
    }

    private function getInputClass(string $key): string {
        $inputClass = "form-control";
        if (isset($this->errors[$key])) {
            $inputClass .= " is-invalid";
        }
        return $inputClass;
    }

    private function getErrorsFeedback(string $key): string {
        if (isset($this->errors[$key])) {
            if (is_array($this->errors[$key]))
                $error = implode('<br>', $this->errors[$key]);
            else
                $error = $this->errors[$key];
            return "<div class='invalid-feedback'>{$error}</div>";  
        }
        return '';
    }
}

?>
