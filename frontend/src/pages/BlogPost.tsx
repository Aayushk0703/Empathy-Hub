import { useEffect, useState } from "react";
import { Link, useParams } from "react-router-dom";
import { ArrowLeft } from "lucide-react";
import Navbar from "@/components/Navbar";
import Footer from "@/components/Footer";
import { apiRequest, type ApiError } from "@/lib/api";

type BlogPostPayload = {
  post: {
    id: number;
    title: string;
    slug: string;
    excerpt: string;
    body: string;
    published_at: string | null;
  };
};

const BlogPost = () => {
  const { slug } = useParams();
  const [post, setPost] = useState<BlogPostPayload["post"] | null>(null);
  const [loading, setLoading] = useState(true);
  const [error, setError] = useState<string | null>(null);

  useEffect(() => {
    let active = true;

    const loadPost = async () => {
      try {
        setLoading(true);
        setError(null);
        const data = await apiRequest<BlogPostPayload>(`/posts/${slug}`);
        if (active) {
          setPost(data.post);
        }
      } catch (err) {
        if (active) {
          setError((err as ApiError).message);
        }
      } finally {
        if (active) {
          setLoading(false);
        }
      }
    };

    if (slug) {
      void loadPost();
    }

    return () => {
      active = false;
    };
  }, [slug]);

  return (
    <div className="min-h-screen bg-background">
      <Navbar />
      <section className="pt-32 pb-20 px-6">
        <div className="max-w-3xl mx-auto">
          <Link
            to="/blog"
            className="inline-flex items-center gap-2 text-muted-foreground hover:text-foreground transition-colors mb-8"
          >
            <ArrowLeft size={16} /> Back to Blog
          </Link>

          {loading ? (
            <div className="space-y-4">
              <div className="h-10 bg-muted rounded-xl animate-pulse" />
              <div className="h-4 bg-muted rounded animate-pulse w-40" />
              <div className="h-64 bg-muted rounded-2xl animate-pulse" />
            </div>
          ) : error || !post ? (
            <div className="rounded-2xl border border-border bg-card p-8">
              <h1 className="font-heading text-2xl text-foreground mb-3">Post unavailable</h1>
              <p className="text-muted-foreground">{error ?? "We couldn't find that article."}</p>
            </div>
          ) : (
            <article className="rounded-3xl border border-border bg-card p-8 md:p-12">
              <p className="text-sm text-primary mb-4">
                {post.published_at
                  ? new Date(post.published_at).toLocaleDateString("en-US", {
                      year: "numeric",
                      month: "long",
                      day: "numeric",
                    })
                  : "Latest article"}
              </p>
              <h1 className="font-heading text-4xl text-foreground mb-4">{post.title}</h1>
              {post.excerpt ? (
                <p className="text-lg text-muted-foreground mb-8">{post.excerpt}</p>
              ) : null}
              <div
                className="prose prose-neutral max-w-none prose-headings:font-heading prose-p:text-foreground/90 prose-li:text-foreground/90"
                dangerouslySetInnerHTML={{ __html: post.body.replace(/\n/g, "<br />") }}
              />
            </article>
          )}
        </div>
      </section>
      <Footer />
    </div>
  );
};

export default BlogPost;
