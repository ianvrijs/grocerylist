<?php
    class db 
    {
        public $oConnection = null;

        function __construct($dbHost = false, $dbName = false,  $dbUser = false, $dbPass = false)
        {
            if(!empty($dbHost) && !empty($dbUser) && !empty($dbName))
            {
                $this->oConnection = new mysqli($dbHost, $dbUser, $dbPass, $dbName);
            }
            if(!empty($this->oConnection->connect_error))
            {
                $sError = 'unsuccefull db connection ' . $this->oConnection->connect_error;
                echo $sError;
                die('accessing db without information');
            }
            if(empty($this->oConnection))
            {
                die('DB IS NULL');
            }
            return true;
        }
   


    public function select($sQuery = false)
    {
        if(!empty($sQuery))
        {
            $sQuery = trim($sQuery);

            if($oResult = $this->oConnection->query($sQuery))
            {
                if($oResult->num_rows > 0) 
                {
                    $aRecords = array();
                    while($aRow = $oResult->fetch_assoc())
                    {
                        //put in records
                        $aRecords[] = $aRow;
                    }

                    $oResult->free_result();
                    return $aRecords; //return result as array
                }
                else 
                {
                    echo 'bad query: no records found.';
                    return array(); //return empty array
                }
            }
            else
            {
                echo 'Query ("'. $sQuery .'") failed: ' . $this->oConnection->error;
            }
        }
        else 
        {
            echo 'No query given in select().';
        }
        return false;
    }
    public function execute($sQuery = false)
    {
        if(!empty($sQuery))
        {
            $sQuery = trim($sQuery);

            if($this->oConnection->query($sQuery))
            {
                return true;
            }
            else {
                echo 'Query failed ' . (empty($this->oConnection->error) ? 'UNKOWN ERROR' : $this->oConnection->error);
            }
        }
        else 
        {
            echo 'no query given in the execute().';
        }
        return false;
    }
}
?>