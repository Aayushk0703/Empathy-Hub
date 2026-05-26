import { useEffect, useState } from "react";
import { motion } from "framer-motion";
import { Link } from "react-router-dom";
import { apiRequest } from "@/lib/api";

const fallbackBlogs = [
  { title: "Heal Your Trauma Today", slug: "/blog" },
  { title: "5 Effective Anger Management Strategies", slug: "/blog" },
  { title: "How to Deal with Body Image Issues", slug: "/blog" },
  { title: "Understanding Depression and Effective Ways to Heal", slug: "/blog" },
  { title: "How to deal with Irrational Fears", slug: "/blog" },
  { title: "How to Stop Procrastination", slug: "/blog" },
];

const BlogSection = () => {
  const [blogs, setBlogs] = useState(fallbackBlogs);

  useEffect(() => {
    let active = true;

    const loadPosts = async () => {
      try {
        const data = await apiRequest<{
          posts: Array<{ title: string; slug: string }>;
        }>("/posts");

        if (active && data.posts.length > 0) {
          setBlogs(
            data.posts.slice(0, 6).map((post) => ({
              title: post.title,
              slug: `/blog/${post.slug}`,
            }))
          );
        }
      } catch {
        // Keep fallback cards when the API is unavailable.
      }
    };

    void loadPosts();

    return () => {
      active = false;
    };
  }, []);

  return (
    <section id="resources" className="py-20 px-4 bg-secondary/40">
      <div className="max-w-6xl mx-auto">
        <motion.div
          initial={{ opacity: 0, y: 20 }}
          whileInView={{ opacity: 1, y: 0 }}
          viewport={{ once: true }}
          className="text-center mb-14"
        >
          <h2 className="font-heading text-3xl md:text-5xl text-foreground">
            self-help <span className="font-bold">for you</span>
          </h2>
        </motion.div>

        <div className="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-5">
          {blogs.map((blog, i) => (
            <motion.div
              key={i}
              initial={{ opacity: 0, y: 20 }}
              whileInView={{ opacity: 1, y: 0 }}
              viewport={{ once: true }}
              transition={{ delay: i * 0.05 }}
              whileHover={{ y: -4 }}
            >
              <Link
                to={blog.slug}
                className="block bg-card rounded-2xl p-6 border border-border hover:border-primary/30 transition-colors group"
              >
                <div className="w-full h-40 rounded-xl bg-primary/10 flex items-center justify-center mb-4">
                  <span className="font-heading text-primary/50 text-2xl">Read</span>
                </div>
                <h3 className="font-heading text-lg text-foreground group-hover:text-primary transition-colors">
                  {blog.title}
                </h3>
              </Link>
            </motion.div>
          ))}
        </div>
      </div>
    </section>
  );
};

export default BlogSection;
