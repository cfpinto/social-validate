<?php
/**
 * Created by PhpStorm.
 * User: claudiopinto
 * Date: 17/11/2018
 * Time: 18:06
 */
namespace  SocialValidate;

use SocialValidate\Validators\ValidatorInterface;

/**
 * Class Validator
 *
 * @package SocialValidate
 */
class Validator
{
    /**
     * @var array 
     */
    protected $drivers = [];

    /**
     * @var ValidatorInterface[] 
     */
    protected $instances = [];

    /**
     * Validator constructor.
     *
     * @param array $drivers
     */
    public function __construct(array $drivers)
    {
        $this->drivers = $drivers;
    }
    
    /**
     * @param string      $driver
     *
     * @return ValidatorInterface
     */
    public function driver(string $driver): ValidatorInterface
    {
        if (!isset($this->drivers[$driver])) {
            throw new \RuntimeException(sprintf('Invalid driver %s.', $driver));
        }
        
        if (empty($this->instances[$driver])) {
            $this->instances[$driver] = new $this->drivers[$driver]();
        }
        
        return $this->instances[$driver];
    }

    /**
     * @param string $url
     *
     * @return null|string
     */
    public function guess(string $url): ?string 
    {
        foreach ($this->drivers as $driver => $class) {
            if (empty($this->instances[$driver])) {
                $this->instances[$driver] = new $class();
            }
            
            if ($this->instances[$driver]->isValid($url)) {
                return $driver;
            }
        }
        
        return null;
    }
}