@php
    $guideUrl = asset('assets/files/'.rawurlencode('Anew Avenue - Preferences.pdf'));
    $helpSections = [
        [
            'title_en' => 'Getting Started',
            'title_es' => 'Primeros pasos',
            'english' => [
                'Create your account, sign in, and save your profile details before starting a session.',
                'Open Preferences to add your practice details, upload a logo, and set your profile picture.',
                'Use Bio-Connect after setup so your profile, messaging, and community features match your current account details.',
            ],
            'spanish' => [
                'Cree su cuenta, inicie sesión y guarde los datos de su perfil antes de comenzar una sesión.',
                'Abra Preferencias para agregar los datos de su consulta, cargar un logotipo y establecer su foto de perfil.',
                'Use Bio-Connect después de la configuración para que su perfil, mensajería y funciones comunitarias coincidan con los datos actuales de su cuenta.',
            ],
        ],
        [
            'title_en' => 'Client Records',
            'title_es' => 'Registros de clientes',
            'english' => [
                'Open Client Info from Data Cache to add a client, review intake details, and keep contact information current.',
                'Use the client record to edit notes, upload consent forms, and review past work from one place.',
                'View Details opens the client Bio or Chakra cache directly so you can move from history to treatment quickly.',
            ],
            'spanish' => [
                'Abra Información del cliente desde Data Cache para agregar un cliente, revisar los datos de ingreso y mantener actualizada la información de contacto.',
                'Use el registro del cliente para editar notas, cargar consentimientos y revisar el trabajo anterior desde un solo lugar.',
                'Ver detalles abre directamente la caché Bio o Chakra del cliente para pasar del historial al tratamiento con rapidez.',
            ],
        ],
        [
            'title_en' => 'Body and Chakra Scans',
            'title_es' => 'Escaneos de cuerpo y chakra',
            'english' => [
                'Choose Body Scan or Chakra Scan from the client session and load the correct model before adding pairs.',
                'Add pairs from the guided scan or search directly in the cache when you already know the point.',
                'Mark the session done when treatment is complete, then print or email the finished scan session from the session view.',
            ],
            'spanish' => [
                'Elija Body Scan o Chakra Scan desde la sesión del cliente y cargue el modelo correcto antes de agregar pares.',
                'Agregue pares desde el escaneo guiado o búsquelos directamente en la caché cuando ya conozca el punto.',
                'Marque la sesión como finalizada cuando termine el tratamiento y luego imprima o envíe por correo la sesión terminada desde la vista de sesión.',
            ],
        ],
        [
            'title_en' => 'Data Cache and Bio-Connect',
            'title_es' => 'Data Cache y Bio-Connect',
            'english' => [
                'Use Data Cache to compare repeated pairs, search by point, and review client sessions by history instead of memory.',
                'Bio-Connect gives you access to profile sharing, messages, friends, and group discussions in the same workflow.',
                'Keep profile details current so shared records, invitations, and contact information stay accurate throughout the app.',
            ],
            'spanish' => [
                'Use Data Cache para comparar pares repetidos, buscar por punto y revisar sesiones de clientes por historial en lugar de memoria.',
                'Bio-Connect le da acceso a compartir perfil, mensajes, amigos y discusiones de grupo dentro del mismo flujo de trabajo.',
                'Mantenga actualizados los datos del perfil para que los registros compartidos, las invitaciones y la información de contacto sigan siendo correctos en toda la aplicación.',
            ],
        ],
    ];
@endphp

<div class="help-summary">
    <h4 style="margin-top: 0;">Help</h4>
    <p style="margin-bottom: 8px;">
        Use the quick guide below for the main workflow, then open the full illustrated manual for screen-by-screen steps.
    </p>
    <p style="margin-bottom: 18px; color: #4a5568;">
        Use la guía rápida a continuación para el flujo principal y luego abra el manual ilustrado completo para ver instrucciones pantalla por pantalla.
    </p>
    <p style="margin-bottom: 0;">
        <a class="btn btn-primary" href="{{ $guideUrl }}" target="_blank" rel="noopener">
            Open Full Guide<br>
            <small>Abrir guía completa</small>
        </a>
    </p>
</div>

<div class="row" style="margin-top: 20px;">
    @foreach ($helpSections as $section)
        <div class="col-md-6" style="margin-bottom: 20px;">
            <div class="panel panel-default" style="height: 100%; margin-bottom: 0;">
                <div class="panel-heading">
                    <strong>{{ $section['title_en'] }}</strong><br>
                    <small>{{ $section['title_es'] }}</small>
                </div>
                <div class="panel-body">
                    <ul style="padding-left: 18px; margin-bottom: 16px;">
                        @foreach ($section['english'] as $item)
                            <li>{{ $item }}</li>
                        @endforeach
                    </ul>
                    <ul style="padding-left: 18px; margin-bottom: 0; color: #4a5568;">
                        @foreach ($section['spanish'] as $item)
                            <li>{{ $item }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    @endforeach
</div>

<div class="panel panel-default" style="margin-bottom: 0;">
    <div class="panel-heading">
        <strong>Illustrated Manual</strong><br>
        <small>Manual ilustrado</small>
    </div>
    <div class="panel-body" style="padding: 0;">
        <iframe
            src="{{ $guideUrl }}"
            title="Anew Avenue Data Cache help guide"
            style="width: 100%; min-height: 720px; border: 0;"
        ></iframe>
    </div>
</div>
