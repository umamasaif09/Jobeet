const API_URL = "http://jobeet.test/api";

export async function getJobs() {
    const response = await fetch(`${API_URL}/jobs`);

    if(!response.ok) {
        throw new Error("Failed to fetch jobs");
    }
    return response.json();
}