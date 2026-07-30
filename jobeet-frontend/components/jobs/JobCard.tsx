
import { Job } from "@/types/job";

import {
    Card,
    CardContent,
    CardHeader,
    CardTitle
} from "@/components/ui/card";
import { Separator } from "../ui/separator";
import Image from "next/image";
import BackButton from "../ui/BackButton";

interface JobCardProps{
    job: Job;
}

export default function JobCard({job}: JobCardProps) {
    return (
      <div className="space-y-6">
        <div className="flex gap-4 items-center">
          <BackButton/>
          <h1 className="font-heading text-xl font-semibold tracking-tight primary-text">
            Job Detail
          </h1>
        </div>
        
        <Card>
            <CardHeader>
              <div className="flex justify-between">
                <div className="space-y-2">
                  <CardTitle className="text-2xl font-semibold">
                    {job.position}
                  </CardTitle>

                  <p className="text-lg">{job.company}</p>
                  <p className="text-sm">{job.location}</p>

                </div>

                  {job.logo && (
                    <Image src={`${process.env.NEXT_PUBLIC_UPLOAD_URL}/${job.logo}`}
                  alt = "Company Logo"
                  width={80}
                  height={80}
                  unoptimized
                  className="rounded-md border object-contain"
                    />
                  )}
              </div>
                
            </CardHeader>
                  <Separator/>
            <CardContent>
              <div className="space-y-4">

                <div>
                  <h3 className="font-semibold">Descrption</h3>
                  <p className="text-sm">{job.description}</p>
                </div>
                <div>
                  <h3 className="font-semibold">How to Apply</h3>
                  <p className="text-sm">{job.how_to_apply}</p>
                </div>
                
                
            </div>
            </CardContent>
        </Card>
      </div>
        
    )
}