export type CreateJobRequest = {
    category_id: number;
    type: string;
    company: string;
    url: string;
    logo: string;
    position: string;
    location: string;
    email: string;
    description: string;
    how_to_apply: string;
    is_public: boolean;
};