<?php  
$requestUri = $_SERVER['REQUEST_URI'];
$path = trim(parse_url($requestUri, PHP_URL_PATH), '/');

?>
                
                <aside class="account-sidebar">
                    <p class="accent-color">Menu</p>
                    <ul>
                        <li class="account-sidebar-item <?= $path === 'admin' ? 'active' : '' ?>"><a href="/admin">Dashboard</a></li>
                        <li class="account-sidebar-item <?= $path === 'admin/reservations' ? 'active' : '' ?>"><a href="/admin/reservations">Reserveringen</a></li>
                        <li class="account-sidebar-item <?= $path === 'admin/users' ? 'active' : '' ?>"><a href="/admin/users">Gebruikers</a></li>
                        <li class="account-sidebar-item <?= $path === 'admin/vehicles' ? 'active' : '' ?>"><a href="/admin/vehicles">Voertuigen</a></li>
                        <li class="account-sidebar-item"><a href="#">Inbox</a></li>
                        <li class="account-sidebar-item"><a href="#">Agenda</a></li> <br>
                        <p class="accent-color">Voorkeuren</p>
                        <li class="account-sidebar-item"><a href="#">Instellingen</a></li>
                        <li class="account-sidebar-item logout"><a href="/logout">Uitloggen</a></li>
                    </ul>

                </aside>