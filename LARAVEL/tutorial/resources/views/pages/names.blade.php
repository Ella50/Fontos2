@extends('layouts.app')
@section('title', '- Nevek')


@section('content')
    {{-- itt lesz a tartalom --}}

    <div class="container">
        <!--<ul>
            @foreach ($names as $name)
                <li @if($name == 'Viktor') style="font-weight: bold;" @endif>
                    @if($loop->last) Utolsó: @endif
                {{ $name }}</li>
            @endforeach
        </ul>-->

        <table class="table table-striped table-hover"> <!--bootstrap-ből-->
            <thead>
                <tr>
                    <th>Azonosító</th>
                    <th>Vezetéknév</th>
                    <th>Keresztnév</th>
                    <th>Létrehozás</th>
                    @auth
                    <th>Műveletek</th> <!--csak akkor lássa és haszálja, ha bejelentkezett-->
                    @endauth
                </tr>
            </thead>
            <tbody>
                @foreach ($names as $name)
                
                    <tr>
                        <td>{{ $name->id }}</td>
                        @empty($name->family)       <!---- ha $name->family == null ---->
                        <td><strong>Nincs adat</strong></td>
                        @else
                        <td>{{ $name->family->surname }}</td>
                        @endempty
                        <td>{{ $name->name }}</td>
                        <td>{{ $name->created_at }}</td>
                        @auth
                        <td>
                            <a href="#" class="btn btn-sm btn-danger btn-delete-name" data-id="{{ $name->id }}">Törlés ÖRÖKRE</a> <!--ez is csak akkor jelenik meg ha bejelentkezett-->
                        </td>
                        @endauth
                    </tr>

                @endforeach

            </tbody>
        </table>

    @auth
        <h3 class="mt-3">Új név hozzáadása</h3>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
      
        <form method="post" action="/names/manage/name/new">
            @csrf 
            <div class="form-group">
                <label for="inputName">Családnév</label>

                <select name="inputFamily" id="inputFamily" class="form-control">
                    @foreach ($families as $family)
                        <option value="{{ $family->id }}">{{ $family->surname }}</option>
                    @endforeach
                </select>

            </div>
            <div class="form-group">
                <label for="inputName">Keresztnév</label>
                <input type="text" class="form-control" id="inputName" name="inputName">
            </div>

            <button type="submit" class="btn btn-primary mt-3">Hozzáadás</button>
        </form>
    @endauth

    </div>


@endsection

@section('script')
<script>

    $(".btn-delete-name").on("click", function() {
        let thisBtn = $(this);
        let id = thisBtn.data("id");
        $.ajax({
            type: "POST",
            url: "/names/delete",
            data: {
                _token: "{{ csrf_token() }}",
                id: id
            },
            success: function() {
                thisBtn.closest("tr").fadeOut();
            },
            error: function() {
                alert("HIBA!");
            }
        });
    });

</script>

@endsection


<script>
    /*---------------Ugyanaz mint az előző, de ez nem működik (gondolom a zárójelek rosszak)--------------
    document.addEventListener("DOMContentLoaded", function() {
        let deleteButtons = document.querySelectorAll("btn-delete-name");

        deleteButtons.foreach(function(button) {
            button.addEventListener("click", function() {
                let id = this.dataset.id;
                let formData = new FormData();
                formData.append("_token", "{{ csrf_token() }}");
                formData.append("id", id);

                fetch("/names/delete", {
                    method: "POST",
                    body: formData,
                })
                .then(response => {
                    if (!response.ok) {
                        throw new Error("HIBA!"); //alert("HIBA VAN (nem sikerült a törlés)!");
                    }
                    return response;
                })
                .then(() => {
                    let row = this.closest("tr");
                    row.style.display = "none";
                })
                .catch(error => {
                    alert(error.message);
                })

            });
        })
    });*/
</script>