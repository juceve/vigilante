<?php

namespace App\Http\Livewire\Admin;

use App\Models\Cliente;
use Livewire\Component;
use PhpOffice\PhpWord\Exception\Exception;
use PhpOffice\PhpWord\TemplateProcessor;

class GenDocs extends Component
{
    public $clientes = null, $selID = "", $cliente = null;

    public $i_cite = "", $i_representante = "", $i_objeto = "", $i_fecha = "", $i_referencia = "", $i_causal = "", $causales = [];

    public function updatedSelID()
    {
        $this->cliente = Cliente::find($this->selID);
        if ($this->cliente) {
            $this->i_representante = $this->cliente->personacontacto;
        } else {
            $this->i_representante = "";
        }
    }

    public function mount()
    {
        $this->clientes = Cliente::all()->pluck('nombre', 'id');
    }

    public function render()
    {
        return view('livewire.admin.gen-docs')->extends('adminlte::page');
    }

    public function i_agregarCausal()
    {
        $this->causales[] = $this->i_causal;
        $this->i_causal = "";
    }

    public function delICausal($i)
    {
        unset($this->causales[$i]);
        $this->causales = array_values($this->causales);
    }

    public function generarInforme()
    {
        try {
            $template = new TemplateProcessor("docs\pt_informe.docx");

            $template->setValue('cite', $this->i_cite);
            $template->setValue('objeto', $this->i_objeto);
            $template->setValue('fecha', fechaEs($this->i_fecha));
            $template->setValue('cliente', $this->cliente->nombre);
            $template->setValue('representante', $this->i_representante);
            $template->setValue('referencia', $this->i_referencia);

            $replacements = array();
            foreach ($this->causales as $item) {
                $replacements[] = array('causal' => $item);
            }

            $template->cloneBlock('causales', 0, true, false, $replacements);

            $tempFile = tempnam(sys_get_temp_dir(), 'PHPWord');
            $template->saveAs($tempFile);

            $headers = [
                "Content-Type: application/octet-stream",
            ];

            return response()->download($tempFile, 'document.docx', $headers)->deleteFileAfterSend(true);
        } catch (Exception $e) {
            return back($e->getCode());
        }
    }
}
