{% extends "base_auth.html.twig" %}

{% block header %}  
<div class="admin">
    <h2>ACCORD-ENERGIE</h2>
    <a href="mesdemandes.php">MES DEMANDES</a>
    <a href="chat.php" class="chat"><img src="images/chat.jpg" ></a>
    <a onclick="return confirm('Êtes-vous sûr de vouloir vous déconnecter ?')" href="deconnexion.php">DECONNEXION</a>
    <img src="photo/{{ photo }}" class="photo">
</div>
{% endblock %}

{% block body %}
    <ul class="ul1">
        {% for user in users %}
        <li>
            <form action="mesdemandes.php" method="POST">
            {{ user.nom }} {{ user.prenom }} 
            <input type="text" name="role_name" value="{{ user.nom_role }}">
            <input type="hidden" name="user_id" value="{{ user.idu }}">
            <button type="submit" name="edituser">Mettre à jour</button>
            {% if msg and msgId == user.idu %}
                <span class="msg">{{ msg }}</span>
            {% endif %}
            </form>
            <div class="es">
                <a onclick="return confirm('Êtes-vous sûr de vouloir supprimer le service?')" href='profile.php?delete_id={{ user.id }}' class="supp"><img src='images/supp.png' width="40"></a>
            </div>
        </li>
        {% endfor %}
    </ul>
{% endblock %}
