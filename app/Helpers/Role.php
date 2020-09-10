<?php

namespace App\Helpers;

class Role {

    //ACCESS
    public static function canView($menu, $views)
    {
        return in_array($menu, $views);
    }

    public static function noAccess()
    {
        return '<i class="fas fa-lock fa-lg text-indigo"></i>';
    }

    //FORM
    public static function addField($menu)
    {
        if($menu->menu_name != 'POS' && $menu->menu_name != 'Riwayat Transaksi' && $menu->menu_name != 'Barcode')
        {
            return '
                <div class="mx-4">

                    <input type="checkbox" id="'.$menu->menu_name.'-add" name="add[]" class="aa" value="1">

                    <label for="'.$menu->menu_name.'-add"><i class="fas fa-plus text-success"></i> Tambah</label>

                </div>
            ';
        }
        else
        {
            return '
                <div class="mx-4" style="display:none;">

                    <input type="checkbox" id="'.$menu->menu_name.'-add" name="add[]" class="aa" value="0">

                    <label for="'.$menu->menu_name.'-add"><i class="fas fa-plus text-success"></i> Tambah</label>

                </div>
            ';
        }
    }

    public static function editField($menu)
    {
        if($menu->menu_name != 'POS' && $menu->menu_name != 'Riwayat Transaksi' && $menu->menu_name != 'Barcode' && $menu->menu_name != 'Pembelian Barang')
        {
            return '
                <div class="mx-4">

                    <input type="checkbox" id="'.$menu->menu_name.'-edit" name="edit[]" class="ae" value="1">

                    <label for="'.$menu->menu_name.'-edit"><i class="fas fa-edit text-warning"></i> Edit</label>

                </div>
            ';
        }
        else
        {
            return '
                <div class="mx-4" style="display:none;">

                    <input type="checkbox" id="'.$menu->menu_name.'-edit" name="edit[]" class="ae" value="0">

                    <label for="'.$menu->menu_name.'-edit"><i class="fas fa-edit text-warning"></i> Edit</label>

                </div>
            ';
        }
    }

    public static function deleteField($menu)
    {
        if($menu->menu_name != 'POS' && $menu->menu_name != 'Barcode')
        {
            return '
                <div class="mx-4">

                    <input type="checkbox" id="'.$menu->menu_name.'-delete" name="delete[]" class="ad" value="1">

                    <label for="'.$menu->menu_name.'-delete"><i class="fas fa-trash text-danger"></i> Hapus</label>

                </div>
            ';
        }
        else
        {
            return '
                <div class="mx-4" style="display:none;">

                    <input type="checkbox" id="'.$menu->menu_name.'-delete" name="delete[]" class="ad" value="0">

                    <label for="'.$menu->menu_name.'-delete"><i class="fas fa-trash text-danger"></i> Hapus</label>

                </div>
            ';
        }
    }

    public static function editViewField($id, $menu, $roles)
    {
        foreach($roles as $role) 
        {
            if($id == $role->pivot->role_id)
            {
                if($role->pivot->view == 1)
                {
                    return '
                        <div class="mx-4">

                            <input type="checkbox" id="'.$menu->menu_name.'-view--edit-'.$id.'" name="view[]" class="av" value="1" checked>

                            <label for="'.$menu->menu_name.'-view--edit-'.$id.'"><i class="fas fa-eye text-secondary"></i> Lihat</label>

                        </div>
                    ';
                }
                else
                {
                    return '
                        <div class="mx-4">

                            <input type="checkbox" id="'.$menu->menu_name.'-view--edit-'.$id.'" name="view[]" class="av" value="1">

                            <label for="'.$menu->menu_name.'-view--edit-'.$id.'"><i class="fas fa-eye text-secondary"></i> Lihat</label>

                        </div>
                    ';
                }
            }
        }
    }

    public static function editAddField($id, $menu, $roles)
    {
        if($menu->menu_name != 'POS' && $menu->menu_name != 'Riwayat Transaksi' && $menu->menu_name != 'Barcode')
        {   
            foreach($roles as $role) 
            {
                if($id == $role->pivot->role_id)
                {
                    if($role->pivot->add == 1)
                    {
                        return '
                            <div class="mx-4">

                                <input type="checkbox" id="'.$menu->menu_name.'-add--edit-'.$id.'" name="add[]" class="aa" value="1" checked>

                                <label for="'.$menu->menu_name.'-add--edit-'.$id.'"><i class="fas fa-plus text-success"></i> Tambah</label>

                            </div>
                        ';
                    }
                    else
                    {
                        return '
                            <div class="mx-4">

                                <input type="checkbox" id="'.$menu->menu_name.'-add--edit-'.$id.'" name="add[]" class="aa" value="1">

                                <label for="'.$menu->menu_name.'-add--edit-'.$id.'"><i class="fas fa-plus text-success"></i> Tambah</label>

                            </div>
                        ';
                    }
                }
            }
        }
        else
        {
            return '
                <div class="mx-4" style="display:none;">

                    <input type="checkbox" id="'.$menu->menu_name.'-add--edit-'.$id.'" name="add[]" class="aa" value="0">

                    <label for="'.$menu->menu_name.'-add--edit-'.$id.'"><i class="fas fa-plus text-success"></i> Tambah</label>

                </div>
            ';
        }
    }

    public static function editEditField($id, $menu, $roles)
    {
        if($menu->menu_name != 'POS' && $menu->menu_name != 'Riwayat Transaksi' && $menu->menu_name != 'Barcode' && $menu->menu_name != 'Pembelian Barang')
        {   
            foreach($roles as $role) 
            {
                if($id == $role->pivot->role_id)
                {
                    if($role->pivot->edit == 1)
                    {
                        return '
                            <div class="mx-4">

                                <input type="checkbox" id="'.$menu->menu_name.'-edit--edit-'.$id.'" name="edit[]" class="ae" value="1" checked>

                                <label for="'.$menu->menu_name.'-edit--edit-'.$id.'"><i class="fas fa-edit text-warning"></i> Edit</label>

                            </div>
                        ';
                    }
                    else
                    {
                        return '
                            <div class="mx-4">

                                <input type="checkbox" id="'.$menu->menu_name.'-edit--edit-'.$id.'" name="edit[]" class="ae" value="1">

                                <label for="'.$menu->menu_name.'-edit--edit-'.$id.'"><i class="fas fa-edit text-warning"></i> Edit</label>

                            </div>
                        ';
                    }
                }
            }
        }
        else
        {
            return '
                <div class="mx-4" style="display:none;">

                    <input type="checkbox" id="'.$menu->menu_name.'-edit--edit-'.$id.'" name="edit[]" class="ae" value="0">

                    <label for="'.$menu->menu_name.'-edit--edit-'.$id.'"><i class="fas fa-edit text-warning"></i> Edit</label>

                </div>
            ';
        }
    }

    public static function editDeleteField($id, $menu, $roles)
    {
        if($menu->menu_name != 'POS' && $menu->menu_name != 'Barcode')
        {   
            foreach($roles as $role) 
            {
                if($id == $role->pivot->role_id)
                {
                    if($role->pivot->delete == 1)
                    {
                        return '
                            <div class="mx-4">

                                <input type="checkbox" id="'.$menu->menu_name.'-delete--edit-'.$id.'" name="delete[]" class="ad" value="1" checked>
        
                                <label for="'.$menu->menu_name.'-delete--edit-'.$id.'"><i class="fas fa-trash text-danger"></i> Hapus</label>
        
                            </div>
                        ';
                    }
                    else
                    {
                        return '
                            <div class="mx-4">

                                <input type="checkbox" id="'.$menu->menu_name.'-delete--edit-'.$id.'" name="delete[]" class="ad" value="1">
            
                                <label for="'.$menu->menu_name.'-delete--edit-'.$id.'"><i class="fas fa-trash text-danger"></i> Hapus</label>
            
                            </div>
                        ';
                    }
                }
            }
        }
        else
        {
            return '
                <div class="mx-4" style="display:none;">

                    <input type="checkbox" id="'.$menu->menu_name.'-delete--edit-'.$id.'" name="delete[]" class="ad" value="0">

                    <label for="'.$menu->menu_name.'-delete--edit-'.$id.'"><i class="fas fa-trash text-danger"></i> Hapus</label>

                </div>
            ';
        }
    }
}
