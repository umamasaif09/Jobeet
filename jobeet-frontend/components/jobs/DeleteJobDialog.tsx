import { deleteJob } from "@/services/jobs";
import { Job } from "@/types/job";
import { AlertDialog, AlertDialogAction, AlertDialogCancel, AlertDialogContent, AlertDialogDescription, AlertDialogFooter, AlertDialogHeader, AlertDialogTitle } from "../ui/alert-dialog";


type Props = {
  open: boolean;
  onOpenChange: (open:boolean) => void;
  onSuccess: () => void;
  job: Job | null;
}

export default function DeleteJobDialog({open, onOpenChange,job, onSuccess}: Props) {
  async function handleDelete() {
    if(!job) return;

    await deleteJob(job.id);
    onSuccess();
    onOpenChange(false);
  }

  return (
    <AlertDialog open = {open} onOpenChange={onOpenChange}>
      <AlertDialogContent>
        <AlertDialogHeader>
          <AlertDialogTitle>
            Delete Job
          </AlertDialogTitle>

          <AlertDialogDescription>
            Are you sure you want to delete{" "}
            <strong>{job?.position}</strong> job post?
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
  );
}