@extends('template')

@section('content')
    <h1>Cadastro de chamado:</h1>
    <form action="#" method="post">
        @csrf
        <div class="row mb-3">
            <div class="col">
                <input type="text" name="name" id="name" class="form-control" placeholder="nome" aria-label="nome">
            </div>
        </div>

        <div class="row mb-3">
            <div class="col">
                <textarea type="text" name="description" id="description" class="form-control" placeholder="Descrição" aria-label="Descrição" rows="5"></textarea>
            </div>
        </div>

        <div class="row mb-3">

            <div class="col">
                <select name="type_id" id="type_id" class="form-select">
                    <option selected>Tipo de chamado</option>
                    <option value="1">Incidente</option>
                    <option value="2">Solicitação de serviço</option>
                </select>
            </div>

            <div class="col">
                <select name="category_id" id="category_id" class="form-select">
                    <option selected> Categoria </option>
                    <option value="1">Impressoras</option>
                    <option value="2">Servidores</option>
                </select>
            </div>

            <div class="col">
                <div class="form-check">
                    <input type="checkbox" name="finished" id="finished" class="form-check-input">
                    <label for="finished" class="form-check-label">Finished</label>
                </div>
            </div>
            
        </div>
        <div class="row mb-3">
            <div class="col">
                <label for="created_date" class="form-label">Created Date:</label>
                <input type="date" name="created_date" id="created_date" class="form-control">
            </div>
            <div class="col">
                <label for="finished_date" class="form-label">Created Date:</label>
                <input type="date" name="finished_date" id="finished_date" class="form-control">
            </div>
        </div>
        <div class="row mb-3">
            <div class="col">
                <input type="submit" value="Enviar" class="btn btn-primary">
            </div>
        </div>
    </form>
@endsection