@extends('layouts.app')

@section('content')
<div class="container">
    <h3 align="center">Dinamically Add / Remove Input fields in Laravel 5.7 using ajax jQuery</h3>
    <br>
    <div class="table-responsive">
        <form method="post" id="dinamis-form">
            <span id="result"></span>
            <table class="table table-bordered table-striped" id="post_table">
                <thead>
                    <tr>
                        <th width="35%">Title</th>
                        <th width="45%">Body</th>
                        <th wifth="20%">Action</th>
                    </tr>
                </thead>
                <tbody>

                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="2" allign="right">&nbsp;</td>
                        <td>@csrf
                            <input type="submit" name="save" id="save" class="btn btn-primary" value="Save" />
                        </td>
                    </tr>
                </tfoot>
            </table>
        </form>
    </div>
</div>
@endsection