@extends('layouts.layout.app')

@section('content')
    <div class="container-fluid p-0">
        <div class="row mb-2 text-end mb-xl-3">
            <div class="col-auto d-none d-sm-block">
                <h3 class="color1"><strong>Gestion </strong>Offres</h3>
            </div>
            <h3 class="color1">Listes des offres</h3>
        </div>
        @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

        @if (auth()->user()->role == 'entreprise')
    <button class="btn bouton" data-toggle="modal" data-target="#addOfferModal">
        <ion-icon name="bag-add-outline"></ion-icon>Poster une offre
    </button>
    @include('backoffice.GestionOffre.create')
@endif

        <div class="row mt-2">
            <div class="col-12">
                @if(session()->has('success'))
                    <div class="alert alert-success">
                        {{ session()->get('success') }}
                    </div>
                @endif

                <div class="data_table">
                    <table id="datatables-reponsive" class="table pt-3 table-striped table-bordered">
                        <thead class="table">
                            <tr>
                                <th>Titre</th>
                                <th>Description</th>
                                <th>Entreprise</th>
                                <th>Actions</th>
                                <th>Profile</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($offres as $offre)
                                <tr>
                                    <td>{{ $offre->titre }}</td>
                                    <td>{{ $offre->description }}</td>
                                    <td>
                                        @if ($offre->entreprise)
                                            {{ $offre->entreprise->nom }}
                                        @else
                                            Entreprise non définie
                                        @endif
                                    </td>

                                     <td>
                                        <a class="btn btn-danger"
                                         href="{{ route('offres.destroy', ['offre' => $offre->id]) }}"
                                         onclick="event.preventDefault(); if(confirm('Voulez-vous vraiment supprimer cette entreprise ?')) document.getElementById('delete-form-{{ $offre->id }}').submit();">
                                         <i class="align-middle" data-feather="trash"></i>
                                         Supprimer
                                     </a>
                                     <form id="delete-form-{{ $offre->id }}"
                                        action="{{ route('offres.destroy', ['offre' => $offre->id]) }}"
                                        method="POST">
                                        @csrf
                                        @method('DELETE')
                                    </form>
                                    </td>
                                    <td>{{ $offre->Profile }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
