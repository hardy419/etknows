<?php

class Hardy_mysql_handler
{
    private $link;

    private $host;
    private $user;
    private $password;
    private $database;

    function __construct($_host, $_user, $_password, $_database)
    {
        $this->link = null;
        $this->host = $_host;
        $this->user = $_user;
        $this->password = $_password;
        $this->database = $_database;
    }
    function __destruct()
    {
        $this->close();
    }

    public function connect()
    {
        if(null === $this->link)
        {
            global $Hardy_config;
            $this->link = mysql_connect($this->host, $this->user, $this->password)
                or die('Could not connect: '.mysql_error());
            mysql_select_db($this->database) or die('Could not select database');
            mysql_query('SET NAMES '.$Hardy_config['connect_char']);
        }
    }
    public function close()
    {
        if($this->link)
        {
            mysql_close($this->link);
            $this->link = null;
        }
    }

    public function query($query)
    {
        if(null === $this->link) $this->connect();
        
        // DEBUG
        //echo "<p>$query</p>";
        // DEBUG (END)
        $lines = array();
        $result = mysql_query($query);
        if(null != $result && TRUE !== $result && FALSE !== $result)
        {
            while($line = mysql_fetch_assoc($result)) {
                $lines[] = $line;
            }
            mysql_free_result($result);
        }
        return $lines;
    }
}


?>