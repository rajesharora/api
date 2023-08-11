<?php
class ConfifController
{
    private $config_file;
    private $config;

    public function __construct()
    {
        $this->config_file = "config.ini";
        $this->config = parse_ini_file($this->config_file);
    }

    public function IMAGE_PATH()
    {
        $image_path = $this->config['IMAGE_URI_PATH'];
        return $image_path;
    }

    public function QUES_PATH()
    {
        $image_path = $this->config['QUES_LOCATION'];
        return $image_path;
    }

    public function getPATH($configVarName)
    {
        $image_path = $this->config[$configVarName];
        return $image_path;
    }


}
?>