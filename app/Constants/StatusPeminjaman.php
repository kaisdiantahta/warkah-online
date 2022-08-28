<?php

namespace App\Constants;

class StatusPeminjaman
{
    const PEMINJAMAN = 1;
    const SELESAI = 2;

    public static function labels(): array
    {
        return [
            "DALAM PEMINJAMAN" => self::PEMINJAMAN,
            "SELESAI" => self::SELESAI,
        ];
    }

    public static function html($status)
    {
    	switch ($status) {
    		case self::PEMINJAMAN:
    			$html = '<span class="badge badge-info">DALAM PEMINJAMAN</span>';
    			break;
    		case self::SELESAI:
    			$html = '<span class="badge badge-success">SELESAI</span>';
    			break;
    	}

    	return $html;
    }
}