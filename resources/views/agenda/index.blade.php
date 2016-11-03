<?php use App\Htt?>
@extends('template')

@include('agenda.modal_contato')

@section('content')

   <div class="row none" id="system_message">
     <div class="col-lg-12">
         <div class="alert" role="alert"></div>
     </div>
   </div>

   <div class="row">
      <div class="col-lg-6 text-left">
         <div class="form-group input-group">
           <input type="text" class="form-control" id="value_search" placeholder="Pesquisa...">
           <span class="input-group-btn">
               <button class="btn btn-default btn-search" type="button"><i class="glyphicon glyphicon-search"></i>
               </button>
           </span>
       </div>
      </div>


      <div class="col-lg-6 text-right">
         <button type="button" class="btn btn-success btn-new">
            <i class="glyphicon glyphicon-plus-sign"></i>
            Novo contato
         </button>
      </div>
   </div>
   
   <br />

   

   <div class="panel panel-default">
      <div class="panel-heading">Agenda de contatos</div>
      <table class="table table-contatos">
         <thead>
            <tr>
               <th>#</th>
               <th>Nome</th>
               <th>Telefone</th>
               <th>E-mail</th>
               <th style="text-align: center">Ações</th>
            </tr>
         </thead>
         <tbody>
         
         @forelse ($agendas as $ag)
             <tr>
               <th scope="row">{{ $ag->id }}</th>
               <td>{{ $ag->name }}</td>
               <td>
                  @if (strlen($ag->phone) === 11)
                     {{ preg_replace("/([0-9]{2})\.?([0-9]{5})\.?([0-9]{4})/", "($1) $2-$3", $ag->phone) }}
                  @else
                     {{ preg_replace("/([0-9]{2})\.?([0-9]{4})\.?([0-9]{4})/", "($1) $2-$3", $ag->phone) }}
                  @endif                  
               </td>
               <td>{{ $ag->email }}</td>
               <td class="col-lg-2 acoes" style="text-align: center">
                  <a href="javascript:void(0)" class="btn btn-success btn-xs editar" data-id="{{ $ag->id }}" data-name="{{ $ag->name }}" data-phone="{{ $ag->phone }}" data-email="{{ $ag->email }}" >Editar</a>
                  <a href="javascript:void(0)" class="btn btn-danger btn-xs del" data-id="{{ $ag->id }}">Excluir</a>
               </td>
            </tr>
         @empty
            <tr>
               <td colspan="5">Não há nenhum registro</td>
            </tr>
         @endforelse

         </tbody>
      </table>
   </div>
@stop

