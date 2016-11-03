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