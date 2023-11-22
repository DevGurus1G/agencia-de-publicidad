<?php
require 'utils/cookie.php';
require 'utils/session.php';
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title><?= $titulo ?></title>
    <? foreach ($estilos as $estilo) : ?>
      <link rel="stylesheet" href="<?= $estilo ?>" />
    <? endforeach; ?>
  </head>
  <body 
  <?php echo $modo === 'dark' ? 'class="dark"' : ''; ?>
  >
    <header>
      <a class="logo-nombre" href="/">
        <svg
          xmlns="http://www.w3.org/2000/svg"
          class="icon"
          width="128"
          height="128"
          viewBox="0 0 512 512"
        >
          <path
            fill="#000000"
            d="M18.53 19.688V61.03c72.043 13.54 136.044 34.786 205.126 63.907v.032c12.827 4.56 21.984 12.106 26.844 21.186c4.94 9.23 5.268 19.71 1.75 28.563c-6.227 15.67-24.807 25.573-45.78 20.374c-10.345 19.927-23.93 39.623-42.407 58.937a298.547 298.547 0 0 0 34.187 18.532H307.5c20.216-54.396 32.977-109.693 38.344-160.937c-104.518-15.22-203.62-46.673-297.813-91.938h-29.5zm317.095 229a713.748 713.748 0 0 1-8.22 24.093h28.94v18.69h-161.69v-.22h-.593l-1.843-.844c-16.61-7.513-32.607-16.53-48.126-27.062l-3.156-2.125c-10.943 4.44-19.705 9.41-25.563 14.342c-7.023 5.915-9.563 11.066-9.563 15.594c0 4.53 2.54 9.71 9.563 15.625c7.023 5.916 18.168 11.9 32.313 16.94c28.29 10.075 68.477 16.56 112.906 16.56c44.428 0 84.648-6.485 112.937-16.56c14.146-5.04 25.29-11.024 32.314-16.94c7.023-5.913 9.562-11.095 9.562-15.624c0-4.527-2.54-9.68-9.562-15.594c-7.024-5.914-18.168-11.9-32.313-16.937c-10.984-3.913-23.774-7.277-37.905-9.938zm-234.03 70.843c-5.044 82.403-40.128 102.984-71.44 125.095c20.57 4.536 43.68 8.43 66.94 7.563c25.204-9.846 51.443-36.288 70.405-57.47c-8.154 19.774-19.6 39.024-34.563 58.376L106.97 492.53c44.538-7.387 86.41-17.235 129.25-46.374c-7.942-20.833-13.978-41.123-18.22-61.187c16.816 26.81 35.478 52.765 57.125 76.655c.03.033.064.06.094.094l31.967 30.655c25.176-31.428 43.748-65.536 58.563-99.875c-.153 15.875-1.45 32.3-5 49.594c43.973 9.924 87.933 3.585 131.906 2.53c-44.83-18.237-70.754-54.62-75.344-123.093c-9.53 7.867-22.24 14.347-37.5 19.783c-31.12 11.084-72.99 17.656-119.218 17.656c-46.227 0-88.068-6.573-119.188-17.658c-15.56-5.542-28.473-12.174-38.062-20.25c-.6-.504-1.175-1.01-1.75-1.53z"
          />
        </svg>
        <h1>Gasteiz Denda</h1>
    </a>
      <form action="/" method="get" id="form-search" >
        <input type="text" name="search" placeholder="Buscar" />
        <svg
          xmlns="http://www.w3.org/2000/svg"
          class="icon"
          width="128"
          height="128"
          viewBox="0 0 24 24"
        >
          <path
            fill="#059669"
            fill-rule="evenodd"
            d="M11 2a9 9 0 1 0 5.618 16.032l3.675 3.675a1 1 0 0 0 1.414-1.414l-3.675-3.675A9 9 0 0 0 11 2Zm-6 9a6 6 0 1 1 12 0a6 6 0 0 1-12 0Z"
            clip-rule="evenodd"
          />
        </svg>
      </form>
      <div class="navs">
        <nav>
          <!-- Para el menu  -->
          <div class="menu-toggle">
            <svg
              xmlns="http://www.w3.org/2000/svg"
              class="icon"
              width="128"
              height="128"
              viewBox="0 0 24 24"
            >
              <path
                fill="none"
                stroke="#059669"
                stroke-linecap="round"
                stroke-linejoin="round"
                stroke-width="1.5"
                d="M3 5h18M3 12h18M3 19h18"
              />
            </svg>
          </div>
          <ul class="navMenu">
            <li>
              <label id="modo"
                ><svg
                  xmlns="http://www.w3.org/2000/svg"
                  class="icon"
                  version="1.1"
                  id="_x32_"
                  width="800px"
                  height="800px"
                  viewBox="0 0 512 512"
                  xml:space="preserve"
                >
                  <g>
                    <path
                      class="st0"
                      d="M256,118.125c-76.156,0-137.875,61.719-137.875,137.875S179.844,393.875,256,393.875   S393.875,332.156,393.875,256S332.156,118.125,256,118.125z"
                    />
                    <rect
                      x="235.906"
                      class="st0"
                      width="40.156"
                      height="77.297"
                    />
                    <rect
                      x="235.906"
                      y="434.703"
                      class="st0"
                      width="40.156"
                      height="77.297"
                    />
                    <rect
                      x="63.657"
                      y="82.229"
                      transform="matrix(0.7071 0.7071 -0.7071 0.7071 102.3047 -42.376)"
                      class="st0"
                      width="77.296"
                      height="40.15"
                    />
                    <polygon
                      class="st0"
                      points="368.156,396.547 422.828,451.219 451.219,422.813 396.563,368.156  "
                    />
                    <rect
                      y="235.906"
                      class="st0"
                      width="77.281"
                      height="40.156"
                    />
                    <polygon
                      class="st0"
                      points="434.688,235.922 434.688,276.078 512,276.063 512,235.906  "
                    />
                    <polygon
                      class="st0"
                      points="60.781,422.813 89.156,451.219 143.813,396.547 115.438,368.156  "
                    />
                    <polygon
                      class="st0"
                      points="451.219,89.156 422.813,60.781 368.156,115.438 396.563,143.844  "
                    />
                  </g></svg
                ><input
                  type="button"
                  id="modo"
                  class="modo"
                  value="Modo Claro/Oscuro"
              /></label>
            </li>
            <? if ($estaLogueado) : ?>
            <li>
              <a href="/user"
                ><svg
                  xmlns="http://www.w3.org/2000/svg"
                  class="icon"
                  height="800px"
                  width="800px"
                  version="1.1"
                  id="_x32_"
                  viewBox="0 0 512 512"
                  xml:space="preserve"
                >
                  <g>
                    <path
                      class="st0"
                      d="M458.159,404.216c-18.93-33.65-49.934-71.764-100.409-93.431c-28.868,20.196-63.938,32.087-101.745,32.087   c-37.828,0-72.898-11.89-101.767-32.087c-50.474,21.667-81.479,59.782-100.398,93.431C28.731,448.848,48.417,512,91.842,512   c43.426,0,164.164,0,164.164,0s120.726,0,164.153,0C463.583,512,483.269,448.848,458.159,404.216z"
                    />
                    <path
                      class="st0"
                      d="M256.005,300.641c74.144,0,134.231-60.108,134.231-134.242v-32.158C390.236,60.108,330.149,0,256.005,0   c-74.155,0-134.252,60.108-134.252,134.242V166.4C121.753,240.533,181.851,300.641,256.005,300.641z"
                    />
                  </g></svg
                >Perfil</a
              >
            </li>
            <? if (isset($tipo) && $tipo== 'tienda') : ?>
            <li>
              <a href="/anuncio/manage">
                <svg width="800px" height="800px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path opacity="0.5" fill-rule="evenodd" clip-rule="evenodd" d="M3 14.25C3.41421 14.25 3.75 14.5858 3.75 15C3.75 16.4354 3.75159 17.4365 3.85315 18.1919C3.9518 18.9257 4.13225 19.3142 4.40901 19.591C4.68577 19.8678 5.07435 20.0482 5.80812 20.1469C6.56347 20.2484 7.56459 20.25 9 20.25H15C16.4354 20.25 17.4365 20.2484 18.1919 20.1469C18.9257 20.0482 19.3142 19.8678 19.591 19.591C19.8678 19.3142 20.0482 18.9257 20.1469 18.1919C20.2484 17.4365 20.25 16.4354 20.25 15C20.25 14.5858 20.5858 14.25 21 14.25C21.4142 14.25 21.75 14.5858 21.75 15V15.0549C21.75 16.4225 21.75 17.5248 21.6335 18.3918C21.5125 19.2919 21.2536 20.0497 20.6517 20.6516C20.0497 21.2536 19.2919 21.5125 18.3918 21.6335C17.5248 21.75 16.4225 21.75 15.0549 21.75H8.94513C7.57754 21.75 6.47522 21.75 5.60825 21.6335C4.70814 21.5125 3.95027 21.2536 3.34835 20.6517C2.74643 20.0497 2.48754 19.2919 2.36652 18.3918C2.24996 17.5248 2.24998 16.4225 2.25 15.0549C2.25 15.0366 2.25 15.0183 2.25 15C2.25 14.5858 2.58579 14.25 3 14.25Z" fill="#1C274C"/>
                <path fill-rule="evenodd" clip-rule="evenodd" d="M12 2.25C12.2106 2.25 12.4114 2.33852 12.5535 2.49392L16.5535 6.86892C16.833 7.17462 16.8118 7.64902 16.5061 7.92852C16.2004 8.20802 15.726 8.18678 15.4465 7.88108L12.75 4.9318V16C12.75 16.4142 12.4142 16.75 12 16.75C11.5858 16.75 11.25 16.4142 11.25 16V4.9318L8.55353 7.88108C8.27403 8.18678 7.79963 8.20802 7.49393 7.92852C7.18823 7.64902 7.16698 7.17462 7.44648 6.86892L11.4465 2.49392C11.5886 2.33852 11.7894 2.25 12 2.25Z" fill="#1C274C"/>
                </svg>
                Crear Anuncio</a>
            </li>
            <? endif;?>
            <li>
              <a href="/chat"
                ><svg
                  xmlns="http://www.w3.org/2000/svg"
                  class="icon"
                  width="800px"
                  height="800px"
                  viewBox="0 0 24 24"
                  fill="none"
                >
                  <path
                    d="M12 22C17.5228 22 22 17.5228 22 12C22 6.47715 17.5228 2 12 2C6.47715 2 2 6.47715 2 12C2 13.5997 2.37562 15.1116 3.04346 16.4525C3.22094 16.8088 3.28001 17.2161 3.17712 17.6006L2.58151 19.8267C2.32295 20.793 3.20701 21.677 4.17335 21.4185L6.39939 20.8229C6.78393 20.72 7.19121 20.7791 7.54753 20.9565C8.88837 21.6244 10.4003 22 12 22Z"
                    fill="#1C274C"
                  />
                  <path
                    d="M15 12C15 12.5523 15.4477 13 16 13C16.5523 13 17 12.5523 17 12C17 11.4477 16.5523 11 16 11C15.4477 11 15 11.4477 15 12Z"
                    fill="white"
                  />
                  <path
                    d="M11 12C11 12.5523 11.4477 13 12 13C12.5523 13 13 12.5523 13 12C13 11.4477 12.5523 11 12 11C11.4477 11 11 11.4477 11 12Z"
                    fill="white"
                  />
                  <path
                    d="M7 12C7 12.5523 7.44772 13 8 13C8.55228 13 9 12.5523 9 12C9 11.4477 8.55228 11 8 11C7.44772 11 7 11.4477 7 12Z"
                    fill="white"
                  /></svg
                >Chats</a
              >
            </li>
            <li>
              <a href="/?cerrar=true"
                ><svg
                  xmlns="http://www.w3.org/2000/svg"
                  class="icon"
                  width="128"
                  height="128"
                  viewBox="0 0 24 24"
                >
                  <path
                    fill="#059669"
                    d="M5 5v14a1 1 0 0 0 1 1h3v-2H7V6h2V4H6a1 1 0 0 0-1 1zm14.242-.97l-8-2A1 1 0 0 0 10 3v18a.998.998 0 0 0 1.242.97l8-2A1 1 0 0 0 20 19V5a1 1 0 0 0-.758-.97zM15 12.188a1.001 1.001 0 0 1-2 0v-.377a1 1 0 1 1 2 .001v.376z"
                  /></svg
                >Cerrar sesion</a
              >
            </li>
            <? else :?>
              <li><a href="/login">
              <svg class="icon" xmlns="http://www.w3.org/2000/svg" width="128" height="128" viewBox="0 0 24 24"><path fill="currentColor" d="M4 21q-.425 0-.713-.288T3 20q0-.425.288-.713T4 19h1V5q0-.825.588-1.413T7 3h10q.825 0 1.413.588T19 5v14h1q.425 0 .713.288T21 20q0 .425-.288.713T20 21H4Zm6-8q.425 0 .713-.288T11 12q0-.425-.288-.713T10 11q-.425 0-.713.288T9 12q0 .425.288.713T10 13Z"/></svg>
                Iniciar Sesion</a></li>
            <? endif;?>
          </ul>
        </nav>

        <nav>
          <div class="menu-filter">
            <svg
              xmlns="http://www.w3.org/2000/svg"
              class="icon"
              width="800px"
              height="800px"
              viewBox="0 0 24 24"
              fill="none"
            >
              <path
                d="M3 4.6C3 4.03995 3 3.75992 3.10899 3.54601C3.20487 3.35785 3.35785 3.20487 3.54601 3.10899C3.75992 3 4.03995 3 4.6 3H19.4C19.9601 3 20.2401 3 20.454 3.10899C20.6422 3.20487 20.7951 3.35785 20.891 3.54601C21 3.75992 21 4.03995 21 4.6V6.33726C21 6.58185 21 6.70414 20.9724 6.81923C20.9479 6.92127 20.9075 7.01881 20.8526 7.10828C20.7908 7.2092 20.7043 7.29568 20.5314 7.46863L14.4686 13.5314C14.2957 13.7043 14.2092 13.7908 14.1474 13.8917C14.0925 13.9812 14.0521 14.0787 14.0276 14.1808C14 14.2959 14 14.4182 14 14.6627V17L10 21V14.6627C10 14.4182 10 14.2959 9.97237 14.1808C9.94787 14.0787 9.90747 13.9812 9.85264 13.8917C9.7908 13.7908 9.70432 13.7043 9.53137 13.5314L3.46863 7.46863C3.29568 7.29568 3.2092 7.2092 3.14736 7.10828C3.09253 7.01881 3.05213 6.92127 3.02763 6.81923C3 6.70414 3 6.58185 3 6.33726V4.6Z"
                stroke="#000000"
                stroke-width="2"
                stroke-linecap="round"
                stroke-linejoin="round"
              />
            </svg>
          </div>
          <ul class="navFilter">
            <li>
              <a href="/"
                ><svg
                  xmlns="http://www.w3.org/2000/svg"
                  class="icon"
                  width="800px"
                  height="800px"
                  viewBox="0 0 192 192"
                  fill="none"
                >
                  <path
                    fill="#000000"
                    fill-rule="evenodd"
                    d="M55.087 40H83c13.807 0 25 11.193 25 25S96.807 90 83 90H52c-.335 0-.668-.007-1-.02V158a6 6 0 0 0 6 6h9a6 6 0 0 0 6-6v-18a6 6 0 0 1 6-6h24a6 6 0 0 1 6 6v18a6 6 0 0 0 6 6h9a6 6 0 0 0 6-6V54c0-14.36-11.641-26-26-26H77c-9.205 0-17.292 4.783-21.913 12ZM39 86.358C31.804 81.97 27 74.046 27 65c0-9.746 5.576-18.189 13.712-22.313C45.528 27.225 59.952 16 77 16h26c16.043 0 29.764 9.942 35.338 24H147c9.941 0 18 8.059 18 18v65c0 9.941-8.059 18-18 18h-6v17c0 9.941-8.059 18-18 18h-9c-9.941 0-18-8.059-18-18v-12H84v12c0 9.941-8.059 18-18 18h-9c-9.941 0-18-8.059-18-18V86.358ZM141 129h6a6 6 0 0 0 6-6V58a6 6 0 0 0-6-6h-6.052c.035.662.052 1.33.052 2v75ZM52 52c-7.18 0-13 5.82-13 13s5.82 13 13 13h31c7.18 0 13-5.82 13-13s-5.82-13-13-13H52Z"
                    clip-rule="evenodd"
                  /></svg
                >Todas las categorias</a
              >
            </li>
            <?php foreach ($categorias as $categoria) {
              echo "<li>
                    <a href='/?id=$categoria[id]'>$categoria[imagen]" .
                ucfirst($categoria['nombre']) .
                "</a>
                    </li>";
            } ?>
            
          </ul>
        </nav>
      </div>
    </header>


