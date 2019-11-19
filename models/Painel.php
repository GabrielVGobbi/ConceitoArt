<?php
class Painel extends model
{

    public function __construct()
    {
        parent::__construct();
        $this->array = array();
        $this->retorno = array();
    }

    public function insert($arr, $tabela, $id_company)
    {
        $certo = true;
        $nome_tabela = $tabela;
        $parametros[] = $id_company;


        foreach ($arr as $key => $value) {
            $nome_coluna[] = '`' . $key . '`';
        }

        $params = implode(',', $nome_coluna);

        $query = "INSERT INTO `$nome_tabela` (`id_company`,$params) VALUES (?";

        foreach ($arr as $key => $value) {
            $nome = $key;
            $valor = $value;
            if ($nome == 'id')
                continue;
            if ($value == '') {
                $certo = false;
                break;
            }
            $query .=  ",?";
            $parametros[] .= $value;
        }

        $query .= ")";

        if ($certo == true) {
            $sql = $this->db->prepare($query);
            if ($sql->execute($parametros)) {
                return $this->retorno = 'sucess';
            } else {
                return $this->retorno = 'error';
            }
        }
    }

    public function edit($arr, $nome_tabela, $id_company, $single = false)
    {
        $certo = true;
        $first = false;

        $query = "UPDATE `$nome_tabela` SET ";
        foreach ($arr as $key => $value) {
            $nome = $key;
            $valor = $value;
            if ($nome == 'acao' || $nome == 'nome_tabela' || $nome == 'id')
                continue;
            if ($value == '') {
                $certo = false;
                break;
            }

            if ($first == false) {
                $first = true;
                $query .= "$nome=?";
            } else {
                $query .= ",$nome=?";
            }

            $parametros[] = $value;
        }

        if ($certo == true) {
            if ($single == false) {
                $parametros[] = $arr['id'];
                $sql = $this->db->prepare($query . ' WHERE id=?');
                $sql->execute($parametros);
            } else {
                $sql = $this->db->prepare($query);
                $sql->execute($parametros);
            }
        }
        return $certo;
    }

    public function resizeImg()
    {


        $a = new Artista();
        $i = new Inventario();


        $dados = $i->getAllNoOffset('', '', 1);

        foreach ($dados as $dd) {

            $artista = str_replace(' ', '_', $dd['art_nome']);

            if (isset($dd['url']) && !empty($dd['url'])) {

                $tmpname = $dd['url'];

                if (file_exists('assets/images/anuncios/' . $artista . '/' . $tmpname)) {
                    if (exif_imagetype('assets/images/anuncios/' . $artista . '/' . $tmpname) == IMAGETYPE_JPEG) {
                        set_time_limit(5000);
                        list($width_orig, $height_orig) = getimagesize('assets/images/anuncios/' . $artista . '/' . $tmpname);
                        $ratio = $width_orig / $height_orig;

                        $width = 500;
                        $height = 500;

                        if ($width / $height > $ratio) {
                            $width = $height * $ratio;
                        } else {
                            $height = $width / $ratio;
                        }



                        $img = imagecreatetruecolor($width, $height);

                        $origi = imagecreatefromjpeg('assets/images/anuncios/' . $artista . '/' . $tmpname);

                        imagecopyresampled($img, $origi, 0, 0, 0, 0, $width, $height, $width_orig, $height_orig);


                        $imgag = imagejpeg($img, 'assets/images/anuncios/' . $artista . '/' . $tmpname, 70);

                        if (is_dir("assets/images/anuncios/" . $artista)) {
                            move_uploaded_file($imgag, 'assets/images/anuncios/' . $artista . '/' . $tmpname);
                        } else {
                            mkdir("assets/images/anuncios/" . $artista);
                            move_uploaded_file($imgag, 'assets/images/anuncios/' . $artista . '/' . $tmpname);
                        }
                    }
                }
            }
        }
        echo "Ok";
    }
}
