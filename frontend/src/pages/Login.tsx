import { useState } from "react";
import { Link } from "react-router-dom";
import { motion } from "framer-motion";
import { Eye, EyeOff, ArrowLeft } from "lucide-react";
import { apiRequest, setAuthToken, type ApiError } from "@/lib/api";
import { toast } from "@/components/ui/sonner";

const Login = () => {
  const [showPassword, setShowPassword] = useState(false);
  const [isAdmin, setIsAdmin] = useState(false);
  const [isSubmitting, setIsSubmitting] = useState(false);
  const [formData, setFormData] = useState({
    email: "",
    password: "",
  });

  const handleSubmit = async (e: React.FormEvent) => {
    e.preventDefault();

    try {
      setIsSubmitting(true);
      if (isAdmin) {
        const response = await fetch("/admin/session-login", {
          method: "POST",
          headers: {
            "Content-Type": "application/json",
            "Accept": "application/json",
          },
          credentials: "same-origin",
          body: JSON.stringify({
            email: formData.email,
            password: formData.password,
          }),
        });

        const payload = await response.json();

        if (!response.ok) {
          throw { message: payload.message } satisfies ApiError;
        }

        toast.success(payload.message);
        window.location.href = payload.redirect_to;
        return;
      }

      const data = await apiRequest<{
        message: string;
        token: string;
        redirect_to: string;
      }>("/auth/login", {
        method: "POST",
        body: JSON.stringify({
          email: formData.email,
          password: formData.password,
        }),
      });

      setAuthToken(data.token);
      toast.success(data.message);
      window.location.href = data.redirect_to;
    } catch (err) {
      toast.error((err as ApiError).message);
    } finally {
      setIsSubmitting(false);
    }
  };

  return (
    <div className="min-h-screen bg-background flex">
      <div className="hidden lg:flex lg:w-1/2 bg-foreground relative overflow-hidden items-center justify-center p-12">
        <div className="absolute inset-0 opacity-10">
          <div className="absolute top-20 left-20 w-72 h-72 rounded-full bg-primary blur-3xl" />
          <div className="absolute bottom-20 right-20 w-96 h-96 rounded-full bg-accent blur-3xl" />
        </div>
        <div className="relative z-10 text-center">
          <div className="w-16 h-16 rounded-full bg-primary flex items-center justify-center mx-auto mb-6">
            <span className="text-primary-foreground font-heading text-2xl">E</span>
          </div>
          <h2 className="font-heading text-4xl text-primary-foreground mb-4">Empthy Hub</h2>
          <p className="font-body text-primary-foreground/60 text-lg max-w-md">
            Your journey to mental wellness begins here. Access personalized therapy and support.
          </p>
        </div>
      </div>

      <div className="w-full lg:w-1/2 flex items-center justify-center p-8">
        <motion.div
          initial={{ opacity: 0, y: 20 }}
          animate={{ opacity: 1, y: 0 }}
          className="w-full max-w-md"
        >
          <Link
            to="/"
            className="inline-flex items-center gap-2 text-muted-foreground hover:text-foreground transition-colors font-body text-sm mb-8"
          >
            <ArrowLeft size={16} /> Back to Home
          </Link>

          <div className="flex bg-muted rounded-full p-1 mb-8">
            <button
              onClick={() => setIsAdmin(false)}
              className={`flex-1 py-2.5 px-4 rounded-full text-sm font-body transition-all ${
                !isAdmin ? "bg-foreground text-background shadow-sm" : "text-muted-foreground"
              }`}
            >
              User Login
            </button>
            <button
              onClick={() => setIsAdmin(true)}
              className={`flex-1 py-2.5 px-4 rounded-full text-sm font-body transition-all ${
                isAdmin ? "bg-foreground text-background shadow-sm" : "text-muted-foreground"
              }`}
            >
              Admin Login
            </button>
          </div>

          <h1 className="font-heading text-3xl text-foreground mb-2">
            {isAdmin ? "Admin Login" : "Welcome Back"}
          </h1>
          <p className="font-body text-muted-foreground mb-8">
            {isAdmin
              ? "Access your admin dashboard to manage sessions and queries."
              : "Sign in to access your therapy sessions and resources."}
          </p>

          <form onSubmit={handleSubmit} className="space-y-5">
            <div>
              <label className="block font-body text-sm text-foreground mb-2">Email Address</label>
              <input
                type="email"
                required
                placeholder="you@example.com"
                value={formData.email}
                onChange={(e) => setFormData((current) => ({ ...current, email: e.target.value }))}
                className="w-full px-4 py-3 rounded-xl border border-border bg-card text-foreground font-body placeholder:text-muted-foreground focus:outline-none focus:ring-2 focus:ring-primary/30 focus:border-primary transition-all"
              />
            </div>

            <div>
              <label className="block font-body text-sm text-foreground mb-2">Password</label>
              <div className="relative">
                <input
                  type={showPassword ? "text" : "password"}
                  required
                  placeholder="Enter your password"
                  value={formData.password}
                  onChange={(e) => setFormData((current) => ({ ...current, password: e.target.value }))}
                  className="w-full px-4 py-3 rounded-xl border border-border bg-card text-foreground font-body placeholder:text-muted-foreground focus:outline-none focus:ring-2 focus:ring-primary/30 focus:border-primary transition-all pr-12"
                />
                <button
                  type="button"
                  onClick={() => setShowPassword(!showPassword)}
                  className="absolute right-4 top-1/2 -translate-y-1/2 text-muted-foreground hover:text-foreground"
                >
                  {showPassword ? <EyeOff size={18} /> : <Eye size={18} />}
                </button>
              </div>
            </div>

            <div className="flex items-center justify-between">
              <label className="flex items-center gap-2 cursor-pointer">
                <input type="checkbox" className="w-4 h-4 rounded border-border text-primary focus:ring-primary" />
                <span className="font-body text-sm text-muted-foreground">Remember me</span>
              </label>
              <a href="#" className="font-body text-sm text-primary hover:underline">Forgot password?</a>
            </div>

            <button
              type="submit"
              disabled={isSubmitting}
              className="w-full py-3.5 bg-foreground text-background rounded-xl font-body font-medium hover:opacity-90 transition-opacity disabled:opacity-60"
            >
              {isSubmitting ? "Signing in..." : isAdmin ? "Login as Admin" : "Sign In"}
            </button>
          </form>

          {!isAdmin && (
            <p className="text-center font-body text-sm text-muted-foreground mt-6">
              Don't have an account?{" "}
              <Link to="/signup" className="text-primary hover:underline font-medium">Sign up</Link>
            </p>
          )}
        </motion.div>
      </div>
    </div>
  );
};

export default Login;
