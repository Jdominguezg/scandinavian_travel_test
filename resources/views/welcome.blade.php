@extends('layouts.app')
<h1 class="text-xl">Bienvenida al gestor de pruebas de Scandinavian Travel</h1>

<small>Este test ha sido desarrollado al completo por Jose Manuel Domínguez Galván.</small>

<h2 class="text-lg mt-4">Seleccione que apartado desea visitar:</h2>

<ul class="text-blue-500 underline">
    <li><a class="py-2 px-4  bg-indigo-600 hover:bg-indigo-700 focus:ring-indigo-500 focus:ring-offset-indigo-200 text-white w-[200px] transition ease-in duration-200 text-center text-base font-semibold shadow-md focus:outline-none focus:ring-2 focus:ring-offset-2  rounded-lg my-2 inline-block" href="{{route('cars')}}">Vehículos</a></li>
    <li><a class="py-2 px-4  bg-indigo-600 hover:bg-indigo-700 focus:ring-indigo-500 focus:ring-offset-indigo-200 text-white w-[200px] transition ease-in duration-200 text-center text-base font-semibold shadow-md focus:outline-none focus:ring-2 focus:ring-offset-2  rounded-lg my-2 inline-block" href="{{route('authors')}}">Autores</a></li>
    <li><a class="py-2 px-4  bg-indigo-600 hover:bg-indigo-700 focus:ring-indigo-500 focus:ring-offset-indigo-200 text-white w-[200px] transition ease-in duration-200 text-center text-base font-semibold shadow-md focus:outline-none focus:ring-2 focus:ring-offset-2  rounded-lg my-2 inline-block" href="{{route('posts')}}">Posts</a></li>
    <li><a class="py-2 px-4  bg-indigo-600 hover:bg-indigo-700 focus:ring-indigo-500 focus:ring-offset-indigo-200 text-white w-[200px] transition ease-in duration-200 text-center text-base font-semibold shadow-md focus:outline-none focus:ring-2 focus:ring-offset-2  rounded-lg my-2 inline-block" href="{{route('locations')}}">Localizaciones</a></li>
</ul>




