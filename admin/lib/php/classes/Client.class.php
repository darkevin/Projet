<?php
class Client {
    private $id;
    private $nom;
    private $prenom;
    private $mail;
    private $mp;
    private $numero;
    private $adresse;
    private $code_postal;
    private $localite;
    
    public function __construct(array $data) {
        $this->hydrate($data);
    }
    public function hydrate(array $data) {
        $tab = array("nom","prenom","mail","mp","numero","adresse","code_postal","localite");
        foreach (array_combine( $tab, $data) as $champ => $valeur) {
            $method = 'set' . ucfirst($champ);
            if (method_exists($this, $method)) {
                $this->$method($valeur);
            }
        }
    }

    function getId() {
        return $this->id;
    }

    function getNom() {
        return $this->nom;
    }

    function getPrenom() {
        return $this->prenom;
    }

    function getMail() {
        return $this->mail;
    }

    function getMp() {
        return $this->mp;
    }

    function getNumero() {
        return $this->numero;
    }

    function getAdresse() {
        return $this->adresse;
    }

    function getCode_postal() {
        return $this->code_postal;
    }

    function getLocalite() {
        return $this->localite;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setNom($nom) {
        $this->nom = $nom;
    }

    function setPrenom($prenom) {
        $this->prenom = $prenom;
    }

    function setMail($mail) {
        $this->mail = $mail;
    }

    function setMp($mp) {
        $this->mp = $mp;
    }

    function setNumero($numero) {
        $this->numero = $numero;
    }

    function setAdresse($adresse) {
        $this->adresse = $adresse;
    }

    function setCode_postal($code_postal) {
        $this->code_postal = $code_postal;
    }

    function setLocalite($localite) {
        $this->localite = $localite;
    }

    
    public function __toString() {
        return $this->nom." ".$this->prenom." ".$this->mail." ".$this->mp." ".$this->numero." ".$this->adresse." ".$this->code_postal." ".$this->localite;
    }
    
    public function toArrayWithoutKeys(){
        return array( $this->nom, $this->prenom, $this->mail, $this->mp, $this->numero, $this->adresse, $this->code_postal, $this->localite);
    }
    public function toArrayWithKeys(){
        return array( $this->nom, $this->prenom, $this->mail, $this->mp, $this->numero, $this->adresse, $this->code_postal, $this->localite);
    }

    
}
