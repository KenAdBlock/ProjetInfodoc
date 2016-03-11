function Confirm(url)
{
    message = "Etes-vous sur de vouloir supprimer ?"
    if(window.confirm(message))
        window.location = url;
}
