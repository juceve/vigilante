<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $role = Role::create(['name' => 'Administrador']);
        $role1 = Role::create(['name' => 'Supervisor']);
        $role2 = Role::create(['name' => 'Usuario']);

        Permission::create(['name' => 'home', 'grupo' => 'Dashboard', 'descripcion' => 'Pantalla inicial'])->assignRole([$role, $role1, $role2]);

        Permission::create(['name' => 'users.index', 'grupo' => 'USUARIOS', 'descripcion' => 'Ver Listado'])->assignRole([$role]);
        Permission::create(['name' => 'users.create', 'grupo' => 'USUARIOS', 'descripcion' => 'Crear'])->assignRole([$role]);
        Permission::create(['name' => 'users.edit', 'grupo' => 'USUARIOS', 'descripcion' => 'Editar'])->assignRole([$role]);
        // Permission::create(['name' => 'users.destroy', 'grupo' => 'USUARIOS', 'descripcion' => 'Eliminar'])->assignRole([$role]);

        Permission::create(['name' => 'admin.roles.index',  'grupo' => 'ROLES', 'descripcion' => 'Ver listado'])->assignRole([$role]);
        Permission::create(['name' => 'admin.roles.create',  'grupo' => 'ROLES', 'descripcion' => 'Crear'])->assignRole([$role]);
        Permission::create(['name' => 'admin.roles.edit',  'grupo' => 'ROLES', 'descripcion' => 'Editar'])->assignRole([$role]);
        Permission::create(['name' => 'admin.roles.destroy',  'grupo' => 'ROLES', 'descripcion' => 'Eliminar'])->assignRole([$role]);

        Permission::create(['name' => 'designaciones.index',  'grupo' => 'DESIGNACIONES', 'descripcion' => 'Ver listado'])->assignRole([$role]);
        Permission::create(['name' => 'designaciones.create',  'grupo' => 'DESIGNACIONES', 'descripcion' => 'Crear'])->assignRole([$role]);
        Permission::create(['name' => 'designaciones.edit',  'grupo' => 'DESIGNACIONES', 'descripcion' => 'Editar'])->assignRole([$role]);
        Permission::create(['name' => 'designaciones.destroy',  'grupo' => 'DESIGNACIONES', 'descripcion' => 'Eliminar'])->assignRole([$role]);

        Permission::create(['name' => 'admin.registros.panico',  'grupo' => 'REGISTROS', 'descripcion' => 'Panico'])->assignRole([$role]);
        Permission::create(['name' => 'admin.registros.visitas',  'grupo' => 'REGISTROS', 'descripcion' => 'Visitas'])->assignRole([$role]);
        Permission::create(['name' => 'admin.registros.rondas',  'grupo' => 'REGISTROS', 'descripcion' => 'Rondas'])->assignRole([$role]);
        Permission::create(['name' => 'admin.registros.novedades',  'grupo' => 'REGISTROS', 'descripcion' => 'Novedades'])->assignRole([$role]);
        Permission::create(['name' => 'admin.registros.hombrevivo',  'grupo' => 'REGISTROS', 'descripcion' => 'Hombre Vivo'])->assignRole([$role]);
        Permission::create(['name' => 'admin.registros.diaslibres',  'grupo' => 'REGISTROS', 'descripcion' => 'Días libres'])->assignRole([$role]);
        Permission::create(['name' => 'admin.registros.asistencia',  'grupo' => 'REGISTROS', 'descripcion' => 'Asistencias'])->assignRole([$role]);

        Permission::create(['name' => 'admin.generador.informe',  'grupo' => 'GENERADOR DOCS.', 'descripcion' => 'Informe'])->assignRole([$role]);
        Permission::create(['name' => 'admin.generador.memorandum',  'grupo' => 'GENERADOR DOCS.', 'descripcion' => 'Memorandum'])->assignRole([$role]);
        Permission::create(['name' => 'admin.generador.cobro',  'grupo' => 'GENERADOR DOCS.', 'descripcion' => 'Cobro'])->assignRole([$role]);
        Permission::create(['name' => 'admin.generador.recibo',  'grupo' => 'GENERADOR DOCS.', 'descripcion' => 'Recibo'])->assignRole([$role]);
        Permission::create(['name' => 'admin.generador.cotizacion',  'grupo' => 'GENERADOR DOCS.', 'descripcion' => 'Cotización'])->assignRole([$role]);

        Permission::create(['name' => 'clientes.index',  'grupo' => 'CLIENTES', 'descripcion' => 'Ver listado'])->assignRole([$role]);
        Permission::create(['name' => 'clientes.create',  'grupo' => 'CLIENTES', 'descripcion' => 'Crear'])->assignRole([$role]);
        Permission::create(['name' => 'clientes.edit',  'grupo' => 'CLIENTES', 'descripcion' => 'Editar'])->assignRole([$role]);
        Permission::create(['name' => 'clientes.destroy',  'grupo' => 'CLIENTES', 'descripcion' => 'Eliminar'])->assignRole([$role]);

        Permission::create(['name' => 'turnos.index',  'grupo' => 'TURNOS', 'descripcion' => 'Ver listado'])->assignRole([$role]);
        Permission::create(['name' => 'turnos.create',  'grupo' => 'TURNOS', 'descripcion' => 'Crear'])->assignRole([$role]);
        Permission::create(['name' => 'turnos.edit',  'grupo' => 'TURNOS', 'descripcion' => 'Editar'])->assignRole([$role]);
        Permission::create(['name' => 'turnos.destroy',  'grupo' => 'TURNOS', 'descripcion' => 'Eliminar'])->assignRole([$role]);
        Permission::create(['name' => 'turnos.ctrlpuntos',  'grupo' => 'TURNOS', 'descripcion' => 'Puntos de Control'])->assignRole([$role]);

        Permission::create(['name' => 'empleados.index',  'grupo' => 'EMPLEADOS', 'descripcion' => 'Ver listado'])->assignRole([$role]);
        Permission::create(['name' => 'empleados.create',  'grupo' => 'EMPLEADOS', 'descripcion' => 'Crear'])->assignRole([$role]);
        Permission::create(['name' => 'empleados.edit',  'grupo' => 'EMPLEADOS', 'descripcion' => 'Editar'])->assignRole([$role]);
        Permission::create(['name' => 'empleados.destroy',  'grupo' => 'EMPLEADOS', 'descripcion' => 'Eliminar'])->assignRole([$role]);

        Permission::create(['name' => 'areas.index',  'grupo' => 'AREAS', 'descripcion' => 'Ver listado'])->assignRole([$role]);
        Permission::create(['name' => 'areas.create',  'grupo' => 'AREAS', 'descripcion' => 'Crear'])->assignRole([$role]);
        Permission::create(['name' => 'areas.edit',  'grupo' => 'AREAS', 'descripcion' => 'Editar'])->assignRole([$role]);
        Permission::create(['name' => 'areas.destroy',  'grupo' => 'AREAS', 'descripcion' => 'Eliminar'])->assignRole([$role]);

        Permission::create(['name' => 'oficinas.index',  'grupo' => 'OFICINAS', 'descripcion' => 'Ver listado'])->assignRole([$role]);
        Permission::create(['name' => 'oficinas.create',  'grupo' => 'OFICINAS', 'descripcion' => 'Crear'])->assignRole([$role]);
        Permission::create(['name' => 'oficinas.edit',  'grupo' => 'OFICINAS', 'descripcion' => 'Editar'])->assignRole([$role]);
        Permission::create(['name' => 'oficinas.destroy',  'grupo' => 'OFICINAS', 'descripcion' => 'Eliminar'])->assignRole([$role]);
    }
}
