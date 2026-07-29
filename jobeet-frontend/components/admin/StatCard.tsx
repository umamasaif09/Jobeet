import { Card, CardContent, CardHeader, CardTitle } from "../ui/card";

type Props = {
  title: string;
  value: number;
}

export default function StatCard({title, value}: Props) {
  return(
    <Card >
        <CardHeader>
          <CardTitle className="text-center">{title}</CardTitle>
        </CardHeader>

        <CardContent>
          <p className="text-3xl font-bold text-center">{value}</p>
          <p className="text-center">Total {title} </p>
        </CardContent>
      </Card>
  )
}