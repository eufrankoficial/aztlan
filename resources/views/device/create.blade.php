@extends('layouts.default', ['title' => 'Novo', 'breadcrumb' => 'device.create'])
@section('content')
    <div class="row">
        <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
                <div class="inner">
                    <h3>Online</h3>
                    <p>Status</p>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Informações do dispositivo</h3>
                </div>
                <form>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="codeDevice">Código</label>
                                    <input type="text" class="form-control" id="codeDevice" name="code_device">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Veículo</label>
                                    <select class="form-control select2" style="width: 100%;">
                                        <option selected="selected">Alabama</option>
                                        <option>Alaska</option>
                                        <option>California</option>
                                        <option>Delaware</option>
                                        <option>Tennessee</option>
                                        <option>Texas</option>
                                        <option>Washington</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="observacao">Observação</label>
                                    <input type="text" class="form-control" id="observacao" name="observacao">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <p>Detalhes (<code>Não obrigatório</code>)</p>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="description">Descrição</label>
                                    <input type="text" class="form-control" id="description" name="description">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="lat">Latitude</label>
                                    <input type="text" class="form-control" id="lat" name="lat">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="long">Longitude</label>
                                    <input type="text" class="form-control" id="long" name="long">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="bat">Bateria</label>
                                    <input type="text" class="form-control" id="bat" name="bat">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="temperatura">Temperatura</label>
                                    <input type="text" class="form-control" id="temperatura" name="temp">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="umi">Umidade</label>
                                    <input type="text" class="form-control" id="umi" name="umi">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="co2">CO2</label>
                                    <input type="text" class="form-control" id="co2" name="co2">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="co2">CO3</label>
                                    <input type="text" class="form-control" id="co2" name="co2">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Salvar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
