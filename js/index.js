function confirmDelete()
{
    if(confirm("Are you sure you want to delete the selected students?") == true)
    {
        document.getElementById("deleteForm").submit();
    }
}