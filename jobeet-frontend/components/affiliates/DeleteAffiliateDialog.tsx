
import { deleteAffiliate } from "@/services/affiliates";
import { Affiliate } from "@/types/affiliate";
import { AlertDialog, AlertDialogAction, AlertDialogCancel, AlertDialogContent, AlertDialogDescription, AlertDialogFooter, AlertDialogHeader, AlertDialogTitle } from "../ui/alert-dialog";


type Props = {
  open: boolean;
  onOpenChange: (open:boolean) => void;
  onSuccess: () => void;
  affiliate: Affiliate | null;
}

export default function DeleteAffiliateDialog({open, onOpenChange, onSuccess, affiliate}: Props) {
  async function handleDelete() {
    if(!affiliate) return;

    await deleteAffiliate(affiliate.id);
    onSuccess();
    onOpenChange(false);
  }

  return(
    <AlertDialog open = {open} onOpenChange={onOpenChange}>
      <AlertDialogContent>
        <AlertDialogHeader>
          <AlertDialogTitle>
            Delete Affiliate
          </AlertDialogTitle>

          <AlertDialogDescription>
            Are you sure you want to delete{" "}
            <strong>{affiliate?.name}</strong>?
            <br />
          </AlertDialogDescription>
        </AlertDialogHeader>

        <AlertDialogFooter>
          <AlertDialogCancel>
              Cancel
          </AlertDialogCancel>

          <AlertDialogAction onClick={handleDelete}>
            Delete
          </AlertDialogAction>
        </AlertDialogFooter>
        
      </AlertDialogContent>
    </AlertDialog>
  )
} 