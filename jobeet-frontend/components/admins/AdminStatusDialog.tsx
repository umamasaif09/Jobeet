
import { Admin } from "@/types/admin";
import { AlertDialog, AlertDialogAction, AlertDialogCancel, AlertDialogContent, AlertDialogDescription, AlertDialogFooter, AlertDialogHeader, AlertDialogTitle } from "../ui/alert-dialog";
import { activateAdmin, disableAdmin } from "@/services/admins";


type Props = {
  open: boolean;
  onOpenChange: (open: boolean)=> void;
  onSuccess: () => void;
  admin: Admin | null;
}

export default function AdminStatusDialog({open, onOpenChange, onSuccess, admin}: Props) {
  async function handleStatus() {
    if(!admin) return;

    if(admin.is_active== true) {
      await disableAdmin(admin.id.toString());
    }
    else {
      await activateAdmin(admin.id.toString());
    }
    
    onSuccess();
    onOpenChange(false);
  }

  return(
    <AlertDialog open={open} onOpenChange={onOpenChange}>
      <AlertDialogContent>
        <AlertDialogHeader>
          <AlertDialogTitle>
            {admin?.is_active == true? "Disable" : "Activate"} Admin
          </AlertDialogTitle>

          <AlertDialogDescription>
            Are you sure you want to {admin?.is_active == true? "disable" : "activate"}{" "}
            <strong>{admin?.name}</strong>?
            <br />
          </AlertDialogDescription>
        </AlertDialogHeader>

        <AlertDialogFooter>
          <AlertDialogCancel>
            Cancel
          </AlertDialogCancel>

          <AlertDialogAction onClick={handleStatus}>
            {admin?.is_active == true? "Disable" : "Activate"}
          </AlertDialogAction>
        </AlertDialogFooter>
      </AlertDialogContent>
    </AlertDialog>
  )
}