<?php session_start(); ?>
<?php include 'header.php'; ?>
<body class="hold-transition login-page">
<div class="login-box" style="width:40%;">
    <div class="login-logo">
        <p id="date"></p>
        <p id="time" class="bold"></p>
    </div>

    <div class="login-box-body">
        <h4 class="login-box-msg">Entrer L'ID de l'Agent</h4>

        <form id="presence">
            <div class="form-group">
                <select class="form-control" name="status" id="status">
                    <option value="entrée">Entrée</option>
                    <option value="sortie">Sortie</option>
                </select>
            </div>
            <div class="form-group has-feedback">
                <input type="text" class="form-control input-lg" id="agent" name="agent" placeholder="Entrer l'ID Agent" required>
                <span class="glyphicon glyphicon-calendar form-control-feedback"></span>
            </div>
            <div class="row">
                <!--<div class="col-xs-4">
                    <button type="submit" class="btn btn-primary btn-block btn-flat" name="signin" id="signin-button"><i class="fa fa-sign-in"></i> Sign In</button>
                </div>-->
            </div>
        </form>
    </div>
    <div class="alert alert-success alert-dismissible mt20 text-center" style="display:none;">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        <span class="result"><i class="icon fa fa-check"></i> <span class="message"></span></span>
    </div>
    <div class="alert alert-danger alert-dismissible mt20 text-center" style="display:none;">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        <span class="result"><i class="icon fa fa-warning"></i> <span class="message"></span></span>
    </div>
</div>

<?php include 'scripts.php' ?>
<script type="text/javascript">
$(function() {
    moment.locale('fr');
    var interval = setInterval(function() {
        var momentNow = moment();
        $('#date').html(momentNow.format('dddd').toUpperCase() + ' - ' + momentNow.format('DD MMMM YYYY'));  
        $('#time').html(momentNow.format('HH:mm:ss')); // Heure au format 24 heures
    }, 100);

    function checkFormCompletion() {
    var agent = $('#agent').val().trim();
    var status = $('#status').val();

    if (agent && status) {
      $('#presence').submit(); // Soumet le formulaire
    }
  }
  


  // Écouter les changements dans les champs du formulaire
  $('#presence input, #presence select').on('change keyup', function() {
    checkFormCompletion(); // Vérifie si le formulaire est complet
  });


    function playAudio(messageCode) {
        var audio = new Audio();
        var baseUrl = 'vocal/'; // Répertoire où les fichiers audio sont stockés
        var audioFile = '';

        // Définir les fichiers audio en fonction du code de message
        switch(messageCode) {
            case 'success':
                audioFile = 'autorisation.wav'; // Accès autorisé
                break;
            case 'error':
                audioFile = 'AccesRefuse.wav'; // Accès refusé
                break;
            case 'already_in':
                audioFile = 'dejaauthenifier.wav'; // Déjà enregistré
                break;
            case 'time_out':
                audioFile = 'sortie.wav'; // Sortie autorisée
                break;
            default:
                audioFile = 'refuser.wav'; // Fichier audio par défaut en cas de code inconnu
        }

        // Configure et joue le fichier audio
        if (audioFile) {
            audio.src = baseUrl + audioFile;
            audio.play().catch(function(error) {
                console.error('Error playing audio:', error);
            });
        }
    }

    function getMessageCode(response) {
        var messages = {
            'success': 'Opération réussie.',
            'already_in': 'Vous avez déjà enregistré votre arrivée aujourd\'hui.',
            'time_in': 'Arrivée enregistrée avec succès.',
            'no_time_in': 'Impossible d\'enregistrer le départ. Aucun enregistrement d\'arrivée trouvé.',
            'already_out': 'Vous avez déjà enregistré votre départ aujourd\'hui.',
            'time_out': 'Départ enregistré avec succès.',
            'error': 'Une erreur est survenue : ',
            'not_found': 'ID employé non trouvé.'
        };
        if(response.error) {
            return messages[response.message_code] + (response.message || '');
        } else {
            return messages[response.message_code];
        }
    }

    $('#presence').submit(function(e){
        e.preventDefault();
        var presence = $(this).serialize();
        $.ajax({
            type: 'POST',
            url: 'presence.php',
            data: presence,
            dataType: 'json',
            success: function(response){
                var messageCode = response.message_code;
                playAudio(messageCode);
                if(response.error){
                    $('.alert').hide();
                    $('.alert-danger').show();
                    $('.message').html(response.message);
                }
                else{
                    $('.alert').hide();
                    $('.alert-success').show();
                    $('.message').html(response.message);
                    $('#agent').val('');
                }
            }
        });
    });
});
</script>
</body>
</html>
