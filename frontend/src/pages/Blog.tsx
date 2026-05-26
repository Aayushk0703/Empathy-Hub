import { useEffect, useState } from "react";
import { Link } from "react-router-dom";
import Navbar from "@/components/Navbar";
import Footer from "@/components/Footer";
import { ExternalLink } from "lucide-react";
import { motion } from "framer-motion";
import { apiRequest } from "@/lib/api";

interface BlogPost {
  id: number;
  title: string;
  description: string;
  slug?: string;
  externalUrl?: string;
  date: string;
}

const fallbackPosts: BlogPost[] = [
  {
    id: 1,
    title: "Understanding Anxiety: Tips & Insights",
    description: "Learn effective strategies to manage anxiety and find peace in daily life.",
    externalUrl: "https://www.instagram.com/empathyhub.in",
    date: "2026-04-15"
  },
  {
    id: 2,
    title: "Building Healthy Relationships",
    description: "Tips on communication and emotional boundaries in relationships.",
    externalUrl: "https://www.instagram.com/empathyhub.in",
    date: "2026-04-10"
  },
  {
    id: 3,
    title: "Self-Care Practices for Mental Wellness",
    description: "Daily habits that can improve your mental health and well-being.",
    externalUrl: "https://www.instagram.com/empathyhub.in",
    date: "2026-04-05"
  },
];

const Blog = () => {
  const [posts, setPosts] = useState<BlogPost[]>(fallbackPosts);
  const [source, setSource] = useState<"backend" | "fallback">("fallback");

  useEffect(() => {
    let active = true;

    const loadPosts = async () => {
      try {
        const data = await apiRequest<{
          posts: Array<{
            id: number;
            title: string;
            slug: string;
            excerpt: string;
            published_at: string | null;
          }>;
        }>("/posts");

        if (active && data.posts.length > 0) {
          setPosts(
            data.posts.map((post) => ({
              id: post.id,
              title: post.title,
              description: post.excerpt,
              slug: post.slug,
              date: post.published_at ?? new Date().toISOString().slice(0, 10),
            }))
          );
          setSource("backend");
        }
      } catch {
        setSource("fallback");
      }
    };

    void loadPosts();

    return () => {
      active = false;
    };
  }, []);

  return (
    <div className="min-h-screen bg-background">
      <Navbar />

      <section className="pt-32 pb-20 px-6">
        <div className="max-w-6xl mx-auto">
          <motion.div
            initial={{ opacity: 0, y: 20 }}
            animate={{ opacity: 1, y: 0 }}
            className="text-center mb-16"
          >
            <span className="text-primary font-body text-sm uppercase tracking-widest">Blog</span>
            <h1 className="font-heading text-4xl md:text-5xl text-foreground mt-4 mb-6">
              Latest Articles & Insights
            </h1>
            <p className="text-muted-foreground font-body max-w-2xl mx-auto text-lg">
              Explore our collection of mental health tips, guidance, and practical insights.
            </p>
          </motion.div>

          <div className="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
            {posts.map((post, index) => (
              <motion.div
                key={post.id}
                initial={{ opacity: 0, y: 20 }}
                animate={{ opacity: 1, y: 0 }}
                transition={{ delay: index * 0.1 }}
              >
                {post.slug ? (
                  <Link
                    to={`/blog/${post.slug}`}
                    className="group block bg-card rounded-2xl border border-border overflow-hidden hover:border-primary/50 transition-all"
                  >
                    <div className="aspect-video bg-muted flex items-center justify-center">
                      <div className="w-20 h-20 rounded-full bg-primary/15 flex items-center justify-center group-hover:bg-primary/25 transition-colors">
                        <span className="font-heading text-primary">Read</span>
                      </div>
                    </div>
                    <div className="p-5">
                      <div className="flex items-center justify-between mb-2">
                        <span className="text-muted-foreground font-body text-xs">
                          {new Date(post.date).toLocaleDateString("en-US", {
                            year: "numeric",
                            month: "short",
                            day: "numeric"
                          })}
                        </span>
                        <ExternalLink size={14} className="text-muted-foreground" />
                      </div>
                      <h3 className="font-heading text-lg text-foreground mb-2 group-hover:text-primary transition-colors">
                        {post.title}
                      </h3>
                      <p className="font-body text-sm text-muted-foreground line-clamp-2">
                        {post.description}
                      </p>
                    </div>
                  </Link>
                ) : (
                  <a
                    href={post.externalUrl}
                    target="_blank"
                    rel="noopener noreferrer"
                    className="group block bg-card rounded-2xl border border-border overflow-hidden hover:border-primary/50 transition-all"
                  >
                    <div className="aspect-video bg-muted flex items-center justify-center">
                      <div className="w-20 h-20 rounded-full bg-primary/15 flex items-center justify-center group-hover:bg-primary/25 transition-colors">
                        <span className="font-heading text-primary">View</span>
                      </div>
                    </div>
                    <div className="p-5">
                      <div className="flex items-center justify-between mb-2">
                        <span className="text-muted-foreground font-body text-xs">
                          {new Date(post.date).toLocaleDateString("en-US", {
                            year: "numeric",
                            month: "short",
                            day: "numeric"
                          })}
                        </span>
                        <ExternalLink size={14} className="text-muted-foreground" />
                      </div>
                      <h3 className="font-heading text-lg text-foreground mb-2 group-hover:text-primary transition-colors">
                        {post.title}
                      </h3>
                      <p className="font-body text-sm text-muted-foreground line-clamp-2">
                        {post.description}
                      </p>
                    </div>
                  </a>
                )}
              </motion.div>
            ))}
          </div>

          <motion.div
            initial={{ opacity: 0, y: 20 }}
            animate={{ opacity: 1, y: 0 }}
            transition={{ delay: 0.5 }}
            className="mt-16 text-center"
          >
            {source === "backend" ? null : (
              <a
                href="https://www.instagram.com/empathyhub.in"
                target="_blank"
                rel="noopener noreferrer"
                className="inline-flex items-center gap-2 bg-gradient-to-tr from-yellow-400 via-orange-500 to-pink-600 text-white px-8 py-3.5 rounded-full font-body hover:opacity-90 transition-opacity"
              >
                View More on Instagram
              </a>
            )}
          </motion.div>
        </div>
      </section>

      <Footer />
    </div>
  );
};

export default Blog;
