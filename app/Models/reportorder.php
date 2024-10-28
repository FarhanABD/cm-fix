<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class reportorder extends Model
{
    use HasFactory;

    public function getReportData() {
    $query = "SELECT id, name, email FROM orders ORDER BY id ASC";
    $result = $this->db->query($query);
    $data = array();
    while ($row = $result->fetch_assoc()) {
      $data[] = $row;
    }
    return $data;
  }
}