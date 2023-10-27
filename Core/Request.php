<?php 

declare(strict_types = 1);

namespace Framework\Core;

use Exception;
use Framework\Core\Enums\RequestParameterType;

class Request 
{
    private array $params = [];
    private array $errors = [];

    public function __construct()
    {
        $method = $_SERVER['REQUEST_METHOD'];
        $this->params = $method === 'GET' ? $_GET : $_POST;
    }

    public function __get($name)
    {
        if (!isset($this->params[$name])) {
            throw new Exception("Parameter: $name doesn't exist in request");
        }
        return $this->params[$name];
    }

    public function all(): array 
    {
        return $this->params;
    }

    // validate function check request doesnt have forbidden parameters, containts all required parameters and required parameters are not empty
    public function validate(array $options): bool
    {
        if (!empty(array_diff_key($this->params, $options))) {
            throw new Exception('request contains forbidden parameters');
        }

        $password = null;
        $confirm_password = null;

        foreach ($options as $key => $value) 
        {
            $parameters = explode('|', $value);
            $required = $parameters[0] === 'required' ? true : false;
            $type = null;
            $min = $this->getValueFromOptionsByName('min', $value) ?? 0;
            $max = $this->getValueFromOptionsByName('max', $value) ?? INF;

            if (isset($parameters[1])) {
                $type = $parameters[1];
                try {
                    RequestParameterType::from($type);
                } catch(Exception $except) {
                    $this->errors[] = $except;
                }
            }

            if ($type === 'password') {
                $password = $this->params['password'];
            }

            if ($type === 'confirm_password') {
                $confirm_password = $this->params['confirm_password'];
            }

            if ($required) {
                if (!array_key_exists($key, $this->params)) {
                    $this->errors[] = $key . ' is required';
                }

                if (!strlen($this->params[$key])) {
                    $this->errors[] = $key . ' cannot be empty';
                }
            }
        }

        if (!is_null($password) && !is_null($confirm_password)) {
            if ($password !== $confirm_password) {
                $this->errors[] = 'Passwords are not the same';
            }
        }

        if (!empty($this->errors)) {
            $this->resetRequestParameters();
            return false;
        }

        return true;
    }

    private function getValueFromOptionsByName(string $option_name, string $search_string)
    {
        $option_name_pos = strpos($search_string, $option_name);

        if (!$option_name_pos) {
            return null;
        }

        $end_pos = strpos($search_string, '|', $option_name_pos);
        $option_name_pos += strlen($option_name) + 1;
        if (!$end_pos) {
            $end_pos = strlen($search_string);
        }

        return substr($search_string, $option_name_pos, $end_pos - $option_name_pos);
    }

    private function resetRequestParameters(): void
    {
        $this->params = [];
    }

    public function errors(): array
    {
        return $this->errors;
    }
}