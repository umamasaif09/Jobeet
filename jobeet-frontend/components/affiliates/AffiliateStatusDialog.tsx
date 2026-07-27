import { activateAffiliate, disableAffiliate } from "@/services/affiliates";
import { Affiliate } from "@/types/affiliate";
import { AlertDialog, AlertDialogAction, AlertDialogCancel, AlertDialogContent, AlertDialogDescription, AlertDialogFooter, AlertDialogHeader, AlertDialogTitle } from "../ui/alert-dialog";


type Props = {
  open: boolean;
  onOpenChange: (open:boolean) => void;
  onSuccess: () => void;
  affiliate: Affiliate | null;
}

export default function DeleteAffiliateDialog({open, onOpenChange, onSuccess, affiliate}: Props) {
  async function handleStatus() {
    if(!affiliate) return;

    if(affiliate.is_active == true) {
      await disableAffiliate(affiliate.id);
      onSuccess();
      onOpenChange(false);
    }
    else{
      await activateAffiliate(affiliate.id);
      onSuccess();
      onOpenChange(false);
    }
  }

  return(
    <AlertDialog open = {open} onOpenChange={onOpenChange}>
      <AlertDialogContent>
        <AlertDialogHeader>
          <AlertDialogTitle>
            {affiliate?.is_active == true? "Disable": "Activate"} Affiliate
          </AlertDialogTitle>

          <AlertDialogDescription>
            Are you sure you want to {affiliate?.is_active == true? "disable" : "activate"}{" "}
            <strong>{affiliate?.name}</strong>?
            <br />
          </AlertDialogDescription>
        </AlertDialogHeader>

        <AlertDialogFooter>
          <AlertDialogCancel>
              Cancel
          </AlertDialogCancel>

          <AlertDialogAction onClick={handleStatus}>
            {affiliate?.is_active == true? "Disable": "Activate"}
          </AlertDialogAction>
        </AlertDialogFooter>
        
      </AlertDialogContent>
    </AlertDialog>
  )
} 