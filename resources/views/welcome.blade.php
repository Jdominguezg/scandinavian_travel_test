@extends('layouts.app')
<h1 class="text-xl">Bienvenida al gestor de pruebas de Scandinavian Travel</h1>

<small>Este test ha sido desarrollado al completo por Jose Manuel Domínguez Galván.</small>

<h2 class="text-lg mt-4">Seleccione que apartado desea visitar:</h2>

<ul class="text-blue-500 underline">
    <li><a href="{{route('cars')}}">Vehículos</a></li>
    <li><a href="{{route('authors')}}">Autores</a></li>
    <li><a href="{{route('posts')}}">Posts</a></li>
    <li><a href="{{route('locations')}}">Localizaciones</a></li>
</ul>


