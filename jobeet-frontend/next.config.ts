import type { NextConfig } from "next";

const nextConfig: NextConfig = {
  /* config options here */
  images: {
    remotePatterns: [
      {
        protocol: "http",
        hostname: "jobeet.test",
        port: "",
        pathname: "/uploads/**",
      },
    ],
  },
};

export default nextConfig;
