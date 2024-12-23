<?php

function getnama($id)
{
    $ci=& get_instance();
    $q = $ci->db->query("select namaPasien from pasien where idPasien='$id'")->row_array();
    return $q['namaPasien'];
}
?>